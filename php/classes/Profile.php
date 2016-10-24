<?php
/**
* Brief explanation of Soundcloud's tag system
*
* This is the profile description of a Soundcloud user. This shows certain attributes of what is stored by Soundcloud when a user establishes an account and uploads a song.
* @author Jonathan Guzman <jguzman41@cnm.edu>
* @version 1.0.0
**/

class Profile {
	/**
	 * id number for this profile; this is the primary key
	 * @var int $profileId
	 **/
	private $profileId;
	/** This is the name chosen by the user for the profile. Attached to each   * song a user uploads.
	 * @var string $profileName
	 **/
	private $profileName;
	/** This is the email used to establish the original profile
	 * @var string $profileEmail
	 */
	private $profileEmail;

	/** constructor goes here later*/
	/**
	 * constructor for this Profile
	 *
	 * @param int|null $newProfileId id of this profile
	 * @param string $newProfileName name for this profile
	 * @param string $newProfileEmail Email address for the profile
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newProfileId = null, string $newProfileName, string $newProfileEmail = null) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileName($newProfileName);
			$this->setProfileEmail($newProfileEmail);
		} catch(\InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			// rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			// rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			// rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}
	

	/** accessor method for profileId
	/**
	 * @return int|null
	 **/
	public function getProfileId() {
		return $this->profileId;
	}

	/**
	 * mutator method for profileId
	 *
	 * @param int|null $newProfileId new value of profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newProfileId is not an integer
	 */

	public function setProfileId(int $newProfileId = null) {

		if ($newProfileId === null) {
		$this->profileId = null;
			return;
		}

		//verify the new profile Id is positive
	 	if($newProfileId <= 0) {
			throw(new \RangeException("profile id is not positive"));
		}

		$this->profileId = $newProfileId;
	}


	/** accessor method for profileEmail*/
	/**
	 * @return string
	 */
	public function getProfileEmail(): string {
		return $this->profileEmail;
	}

	/** mutator method for profileEmail
	 * @param string $newProfileEmail
	 */

	public function setProfileEmail(string $newProfileEmail) {
		if ($newProfileEmail === null) {
			$this->profileEmail = null;
				return;
		}
		$this->profileEmail = $newProfileEmail;
	}

	/** accessor method for profileName */
	/**
	 * @return string
	 */

	public function getProfileName(): string {
		return $this->profileName;
	}

	/** mutator method for profileName
	 *
	 * @param string $newProfileName
	 */

	public function setProfileName(string $newProfileName) {
		if($newProfileName === null) {
			$this->profileName = $newProfileName;
		}
	}

		/**
		 * inserts this profile into mySQL
		 *
		 * @param \PDO $pdo PDO connection object
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError if $pdo is not a PDO connection object
		 **/
		public function insert(\PDO $pdo) {
			// enforce the profileId is null (i.e., don't insert a profile that already exists)
			if($this->profileId !== null) {
				throw(new \PDOException("not a new profile"));
			}

			// create query template
			$query = "INSERT INTO profile(profileId, profileName, profileEmail) VALUES(:ProfileId, :profileName, :profileEmail)";
			$statement = $pdo->prepare($query);

			// bind the member variables to the place holders in the template
			$parameters = ["profileId" => $this->profileId, "profileName" => $this->profileName, "profileEmail" => $this->profileEmail];
			$statement->execute($parameters);

			// update the null profileId with what mySQL just gave us
			$this->profileId = intval($pdo->lastInsertId());
		}


		/**
		 * deletes this profile from mySQL
		 *
		 * @param \PDO $pdo PDO connection object
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError if $pdo is not a PDO connection object
		 **/
		public function delete(\PDO $pdo) {
			// enforce the profileId is not null (i.e., don't delete a profile that hasn't been inserted)
			if($this->profileId === null) {
				throw(new \PDOException("unable to delete a profile that does not exist"));
			}

			// create query template
			$query = "DELETE FROM profile WHERE profileId = :profileId";
			$statement = $pdo->prepare($query);

			// bind the member variables to the place holder in the template
			$parameters = ["profileId" => $this->profileId];
			$statement->execute($parameters);
		}

		/**
		 * updates this profile in mySQL
		 *
		 * @param \PDO $pdo PDO connection object
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError if $pdo is not a PDO connection object
		 **/
		public function update(\PDO $pdo) {
			// enforce the profileId is not null (i.e., don't update a profile that hasn't been inserted)
			if($this->profileId === null) {
				throw(new \PDOException("unable to update a profile that does not exist"));
			}

			// create query template
			$query = "update profile SET profileId = :profileId, profileName = :profileName, profileEmail = :profileEmail WHERE profileId = :profileId";
			$statement = $pdo->prepare($query);

			// bind the member variables to the place holders in the template

			$parameters = ["profileId" => $this->profileId, "profileName" => $this->profileName, "profileEmail" => $this->profileEmail];
			$statement->execute($parameters);
		}
	}


