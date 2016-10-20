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

	/** accessor method for profileId*/
	/**
	 * @return int
	 */
	public function getProfileId(): int {
		return $this->profileId;
	}

	/**
	 * mutator ethod for profileId
	 *
	 * @param int|null $newProfileId new value of profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newProfileId is not an integer
	 */

	/**
	 * @param int $newProfileId
	 */
	public function setProfileId(int $newProfileId = null) {
		if ($newProfileId === null){
		$this->profileId = null;
			return;

	}

//verify the new profile Id is positive
if($newProfileId <= 0) {
	throw(new \RangeException("profile id is not positive"));
}

$this->profileId = $newProfileId;
}


	/**accessor method for profileEmail*/
	/**
	 * @return string
	 */
	public function getProfileEmail(): string {
		return $this->profileEmail;
	}

	/**
	 * @param string $newProfileEmail
	 */
	public function setProfileEmail(string $newProfileEmail = null) {
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

	/**
	 * @param string $newProfileName
	 */
	public function setProfileName(string $newProfileName = null) {
		if ($newProfileName === null) {
			$this->profileName = $newProfileName;
		}

	}

}