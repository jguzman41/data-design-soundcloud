<?php
/**
 * Brief explanation of Soundcloud's tag system
 *
 * This is the song description for a Soundcloud track. This shows certain attributes of what is stored by Soundcloud when a user establishes an account and uploads a song.
 * @author Jonathan Guzman <jguzman41@cnm.edu>
 * @version 1.0.0
 **/

class song {
	/**
	 * id number for this song; this is the primary key
	 * @var int $songId
	 **/
	private $songId;

	/**
	 * This is the name chosen by the user for the song. Attached to each   * song a user uploads.
	 * @var string $songName
	 **/
	private $songName;

	/**
	 * This is the profile used to upload the  original song
	 * @var string $songProfileId
	 */
	private $songProfileId;

	/** This is the date and time a song was uploaded. Attached to each   * song a user uploads.
	 * @var DateTime $songDateTime
	 */
	private $songDateTime;

	/** constructor goes here later*/
	/**
	 * constructor for this song
	 *
	 * @param int|null $newSongId id of this song or null if a new song
	 * @param int $newSongProfileId id of the Profile that sent this song
	 * @param string $newSongName string containing actual song data
	 * @param \DateTime|string|null $newSongDateTime date and time song was sent or null if set to current date and time
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newSongId = null, int $newSongProfileId, string $newSongName, $newSongDateTime = null) {
		try {
			$this->setsongId($newSongId);
			$this->setSongProfileId($newSongProfileId);
			$this->setSongName($newSongName);
			$this->setSongDateTime($newSongDateTime);
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
	/** accessor method for songId
	 * /**
	 * @return int|null
	 **/
	public function getsongId() {
		return $this->songId;
	}

	/**
	 * mutator method for songId
	 *
	 * @param int $newSongId
	 * @param int|null $newSongId new value of song id
	 */

	public function setsongId(int $newSongId = null) {

		if($newSongId === null) {
			$this->songId = null;
			return;
		}

		//verify the new song Id is positive
		if($newSongId <= 0) {
			throw(new \RangeException("song id is not positive"));
		}

		$this->songId = $newSongId;
	}


	/** accessor method for songEmail*/
	/**
	 * @return string
	 */
	public function getSongName(): string {
		return $this->songName;
	}

	/** mutator method for songName
	 * @param string $newSongName
	 */

	public function setSongName(string $newSongName) {
		if($newSongName === null) {
			$this->songName = null;
			return;
		}
		$this->songName = $newSongName;
	}

	/** accessor method for songName */
	/**
	 * @return string
	 */

	public function getSongProfileId(): string {
		return $this->songName;
	}

	/** mutator method for songProfileId
	 *
	 * @param string $newSongProfileId
	 */

	public function setSongProfileId(string $newSongProfileId) {
		if($newSongProfileId === null) {
			$this->songProfileId = $newSongProfileId;
		}

	}


	/**
	* accessor method for songDateTime
	* @return \DateTime for value of new song date and time
	**/
	public function getSongDateTime(): \DateTime {
		return($this->songDateTime);
	}

	/** mutator method for songDateTime
	 * @param \DateTime|string|null $newSongDateTime song date as a DateTime object or string (or null to load current time)
	 * @throws \invalidArgumentException if $newSongDateTime is not a valid object or string
	 * @throws \RangeException if $newSongDatetime is a date that does not exist
	 */

	public function setSongDateTime($newSongDateTime) {
		if($newSongDateTime === null) {
			$this->songDateTime = $newSongDateTime;
					return;
		}
	}

	/**
	 * gets the song by content
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $songName song name to search for
	 * @return \SplFixedArray SplFixedArray of Songs found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getSongBysongName(\PDO $pdo, string $songName) {
		// sanitize the description before searching
		$songName = trim($songName);
		$songName = filter_var($songName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($songName) === true) {
			throw(new \PDOException("song content is invalid"));
		}

		// create query template
		$query = "SELECT songId, songProfileId, songDateTime FROM song WHERE songId LIKE :songId";
		$statement = $pdo->prepare($query);

		// bind the song content to the place holder in the template
		$songName = "$songName";
		$parameters = ["songName" => $songName];
		$statement->execute($parameters);

		// build an array of Songs
		$songs = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$song = new Song($row["songId"], $row["songProfileId"], $row["songName"], $row["songDateTime"]);
				$songs[$songs->key()] = $song;
				$songs->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($songs);
	}

	/**
	 * gets the song by songId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $songId song id to search for
	 * @return Song|null song found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getSongBysongId(\PDO $pdo, int $songId) {
		// sanitize the songId before searching
		if($songId <= 0) {
			throw(new \PDOException("song id is not positive"));
		}

		// create query template
		$query = "SELECT songId, songProfileId, songDateTime FROM song WHERE songId = :songId";
		$statement = $pdo->prepare($query);

		// bind the song id to the place holder in the template
		$parameters = ["songId" => $songId];
		$statement->execute($parameters);

		// grab the song from mySQL
		try {
			$song = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$song = new Song($row["songId"], $row["songProfileId"], $row["songName"], $row["songDateTime"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($song);
	}

	/**
	 * gets the song by profile id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $songProfileId profile id to search by
	 * @return \SplFixedArray SplFixedArray of Songs found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getSongBysongProfileId(\PDO $pdo, int $songProfileId) {
		// sanitize the profile id before searching
		if($songProfileId <= 0) {
			throw(new \RangeException("song profile id must be positive"));
		}

		// create query template
		$query = "SELECT songId, songProfileId, songDateTime FROM song WHERE songProfileId = :songProfileId";
		$statement = $pdo->prepare($query);

		// bind the song profile id to the place holder in the template
		$parameters = ["songProfileId" => $songProfileId];
		$statement->execute($parameters);

		// build an array of songs
		$songs = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$song = new song($row["songId"], $row["songProfileId"], $row["songName"], $row["songDateTime"]);
				$songs[$songs->key()] = $song;
				$songs->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($songs);
	}

	/**
	 * gets all Songs
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Songs found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllSongs(\PDO $pdo) {
		// create query template
		$query = "SELECT songId, songProfileId, songDateTime FROM song";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of songs
		$songs = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$song = new song($row["songId"], $row["songProfileId"], $row["songName"], $row["songDateTime"]);
				$songs[$songs->key()] = $song;
				$songs->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($songs);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["songDateTime"] = $this->songDateTime->getTimestamp() * 1000;
		return($fields);
	}

	/**
	 * inserts this song into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforce the songId is null (i.e., don't insert a song that already exists)
		if($this->songId !== null) {
			throw(new \PDOException("not a new song"));
		}

		// create query template
		$query = "INSERT INTO song(songProfileId, songDateTime) VALUES(:songProfileId,:songDateTime)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDate = $this->songDateTime->format("Y-m-d H:i:s");
		$parameters = ["songProfileId" => $this->songProfileId, "songName" => $this->songName, "songDateTime" => $formattedDate];
		$statement->execute($parameters);

		// update the null songId with what mySQL just gave us
		$this->songId = intval($pdo->lastInsertId());
	}


	/**
	 * deletes this song from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		// enforce the songId is not null (i.e., don't delete a song that hasn't been inserted)
		if($this->songId === null) {
			throw(new \PDOException("unable to delete a song that does not exist"));
		}

		// create query template
		$query = "DELETE FROM song WHERE songId = :songId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["songId" => $this->songId];
		$statement->execute($parameters);
	}

	/**
	 * updates this song in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		// enforce the songId is not null (i.e., don't update a song that hasn't been inserted)
		if($this->songId === null) {
			throw(new \PDOException("unable to update a song that does not exist"));
		}

		// create query template
		$query = "UPDATE song SET songProfileId = :songProfileId, songDateTime = :songDateTime WHERE songId = :songId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDate = $this->songDateTime->format("Y-m-d H:i:s");
		$parameters = ["songProfileId" => $this->songProfileId, "songName" => $this->songName, "songDateTime" => $formattedDate, "songId" => $this->songId];
		$statement->execute($parameters);
	}

}


