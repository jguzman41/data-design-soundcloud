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
}


