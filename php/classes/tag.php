<?php
/**
 * Created by PhpStorm.
 * User: Jonathan
 * Date: 10/20/16
 * Time: 1:53 PM
 */
/**
 * Brief explanation of Soundcloud's tag system
 *
 * This is the description of tags for a Soundcloud tag. This shows certain attributes of what is stored by Soundcloud when a user tags a song.
 * @author Jonathan Guzman <jguzman41@cnm.edu>
 * @version 1.0.0
 **/

class Tag {
	/**
	 * id number for this Tag; this is the primary key
	 * @var int $tagId
	 **/
	private $tagId;

	/** This is the Label chosen by the user for the Tag. Attached to each   * song a user uploads.
	 * @var string $tagLabel
	 **/
	private $tagLabel;

	/**
	 * constructor for this Tag
	 *
	 * @param int|null $newTagId id of this Tag
	 * @param string $newTagLabel Label for this Tag
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newTagId = null, string $newTagLabel) {
		try {
			$this->setTagId($newTagId);
			$this->setTagLabel($newTagLabel);
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

	/** accessor method for tagId
	 *
	 * @return int|null
	 **/
	public function getTagId() {
		return $this->tagId;
	}

	/**
	 * mutator method for tagId
	 *
	 * @param int $newTagId
	 * @param int|null $newTagId new value of tag id
	 */

	public function setTagId(int $newTagId = null) {

		if($newTagId === null) {
			$this->tagId = null;
			return;
		}

		//verify the new tag Id is positive
		if($newTagId <= 0) {
			throw(new \RangeException("tag id is not positive"));
		}

		$this->tagId = $newTagId;
	}

	/** accessor method for tagLabel
	 * @return string
	 */

	public
	function getTagLabel(): string {
		return $this->tagLabel;
	}


	/** mutator method for tagLabel
	 *
	 * @param string $newTagLabel
	 */

	public
	function setTagLabel(string $newTagLabel) {
		if($newTagLabel === null) {
			$this->tagLabel = $newTagLabel;
		}
	}

	/**
	 * inserts this Tag into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforce the tagId is null (i.e., don't insert a Tag that already exists)
		if($this->tagId!== null) {
			throw(new \PDOException("not a new tag"));
		}

		// create query template
		$query = "INSERT INTO tag(tagProfileId, tagSongId, tagLabel) VALUES(tagProfileId, tagSongId, tagLabel)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["tagId" => $this->tagId, "tagLabel" => $this->tagLabel];
		$statement->execute($parameters);

		// update the null tagId with what mySQL just gave us
		$this->tagId = intval($pdo->lastInsertId());
	}


	/**
	 * deletes this Tag from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		// enforce the tagId is not null (i.e., don't delete a Tag that hasn't been inserted)
		if($this->tagId === null) {
			throw(new \PDOException("unable to delete a Tag that does not exist"));
		}

		// create query template
		$query = "INSERT INTO tag(tagProfileId, tagSongId, tagLabel) VALUES(tagProfileId, tagSongId, tagLabel)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["tagId" => $this->tagId];
		$statement->execute($parameters);
	}

	/**
	 * updates this Tag in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		// enforce the tagId is not null (i.e., don't update a Tag that hasn't been inserted)
		if($this->tagId === null) {
			throw(new \PDOException("unable to update a Tag that does not exist"));
		}

		// create query template
		$query = "INSERT INTO tag(tagProfileId, tagSongId, tagLabel) VALUES(tagProfileId, tagSongId, tagLabel)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template

		$parameters = ["tagId" => $this->tagId, "tagLabel" => $this->tagLabel];
		$statement->execute($parameters);
	}
}

