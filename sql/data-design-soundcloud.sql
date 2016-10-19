DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS song;
DROP TABLE IF EXISTS songTag;
DROP TABLE IF EXISTS profile;

CREATE TABLE profile (
	profileId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	profileName VARCHAR (32) NOT NULL,
	profileEmail VARCHAR(128) NOT NULL,
	UNIQUE (profileName),
	UNIQUE (profileEmail),
	INDEX (profileId),
	PRIMARY KEY (profileId)
);

CREATE TABLE song (
	songId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	songProfileId INT UNSIGNED NOT NULL,
	songDateTime DATETIME NOT NULL,
	INDEX (songId),
# 	INDEX (profileId),
	FOREIGN KEY (songProfileId) REFERENCES profile(profileId),
	PRIMARY KEY (songId)
);

CREATE TABLE tag (
	tagProfileId INT UNSIGNED NOT NULL,
	tagSongId INT UNSIGNED NOT NULL,
	tagLabel VARCHAR(32),
	INDEX (tagLabel),
	UNIQUE (tagLabel),
	FOREIGN KEY (tagProfileId) REFERENCES profile(profileId),
	PRIMARY KEY (tagProfileId)
);

CREATE TABLE songTag (
	songTagProfileId INT UNSIGNED NOT NULL,
	songTagSongId INT UNSIGNED NOT NULL,
	FOREIGN KEY (songTagProfileId) REFERENCES profile(profileId),
	FOREIGN KEY (songTagSongId) REFERENCES song(songId),
	PRIMARY KEY (songTagProfileId, songTagSongId)
);

