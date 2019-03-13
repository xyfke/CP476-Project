# Testiing on local server
DROP DATABASE IF EXISTS `APlusDB`;
CREATE DATABASE IF NOT EXISTS `APlusDB`;
Use `APlusDB`;

# Test on hopper
#Use 'kexx7130';

# CREATE Table for User
DROP TABLE IF EXISTS `User`;

CREATE TABLE `User` (
    `UserID` INTEGER NOT NULL AUTO_INCREMENT,
    `Username` VARCHAR(20) NOT NULL,
    `FirstName`  VARCHAR(50) NOT NULL,
    `LastName` VARCHAR(50) NOT NULL,
    `UserPassword` VARCHAR(20) NOT NULL,
    `Email` VARCHAR(254) NOT NULL,
    `ShortBio` LONGTEXT,
    INDEX (`UserID`),
    PRIMARY KEY (`UserID`)
 ) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;

# Create table for Session
DROP TABLE IF EXISTS `Session`;

CREATE TABLE `Session` (
    `SessionID` INTEGER NOT NULL AUTO_INCREMENT,
    `SessionName` VARCHAR(50) NOT NULL,
    `Timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX(`SessionID`),
    PRIMARY KEY (`SessionID`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;

# Create Table UserSession (Connects User and Session)
DROP TABLE IF EXISTS `UserSession`;

CREATE TABLE `UserSession` (
    `UserID` INTEGER NOT NULL,
    `SessionID` INTEGER NOT NULL,
    `UserType` INTEGER NOT NULL,
    `Status` INTEGER NOT NULL,
    INDEX (`UserID`),
    INDEX (`SessionID`),
    PRIMARY KEY (`UserID`, `SessionID`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;

# CREATE TABLE Line
DROP TABLE IF EXISTS `Line`;

CREATE TABLE `Line` (
    `LineID` INTEGER NOT NULL AUTO_INCREMENT,
    `SessionID` INTEGER NOT NULL,
    INDEX (`LineID`),
    INDEX (`SessionID`),
    PRIMARY KEY (`LineID`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;

# CREATE TABLE Point
DROP TABLE IF EXISTS `Point`;

CREATE TABLE `Point` (
    `PointID` INTEGER NOT NULL AUTO_INCREMENT,
    `LineID` INTEGER NOT NULL,
    `PointX` INTEGER NOT NULL DEFAULT 0,
    `PointY` INTEGER NOT NULL DEFAULT 0,
    INDEX (`LineID`),
    INDEX (`PointID`),
    PRIMARY KEY (`PointID`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;

# CREATE MESSAGE TABLE
DROP TABLE IF EXISTS `Message`;

CREATE TABLE `Message` (
    `MessageID` INTEGER NOT NULL AUTO_INCREMENT,
    `UserID` INTEGER NOT NULL,
    `SessionID` INTEGER NOT NULL,
    `MessageContent` LONGTEXT,
    `Timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (`MessageID`),
    INDEX (`UserID`),
    INDEX (`SessionID`),
    PRIMARY KEY (`MessageID`)
 ) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;

SHOW WARNINGS;




