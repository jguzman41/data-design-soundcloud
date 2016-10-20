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
	 * id number for this profile; this is the primary key
	 * @var int $tagId
	 **/
	private $tagId;

	/** This is the name chosen by the user for the profile. Attached to each   * song a user uploads.
	 * @var string $tagLabel
	 **/
	private $tagLabel;


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
}

