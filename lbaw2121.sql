-----------------------------------------
-- Drop old schema
-----------------------------------------

DROP TABLE IF EXISTS Users CASCADE;
DROP TABLE IF EXISTS AdminUser CASCADE;
DROP TABLE IF EXISTS Advertiser CASCADE;
DROP TABLE IF EXISTS Wallet CASCADE;
DROP TABLE IF EXISTS Content CASCADE;
DROP TABLE IF EXISTS ContentLike CASCADE;
DROP TABLE IF EXISTS TextContent CASCADE;
DROP TABLE IF EXISTS TextReply CASCADE;
DROP TABLE IF EXISTS MediaContent CASCADE;
DROP TABLE IF EXISTS Video CASCADE;
DROP TABLE IF EXISTS Image CASCADE;
DROP TABLE IF EXISTS Comment CASCADE;
DROP TABLE IF EXISTS FriendRequest CASCADE;
DROP TABLE IF EXISTS AcceptedFriendRequest CASCADE;
DROP TABLE IF EXISTS RejectedFriendRequest CASCADE;
DROP TABLE IF EXISTS Message CASCADE;
DROP TABLE IF EXISTS MessageUser CASCADE;
DROP TABLE IF EXISTS Groups CASCADE;
DROP TABLE IF EXISTS UserGroupModerator CASCADE;
DROP TABLE IF EXISTS UserGroupMember CASCADE;
DROP TABLE IF EXISTS Interest CASCADE;
DROP TABLE IF EXISTS InterestUser CASCADE;
DROP TABLE IF EXISTS Locale CASCADE;
DROP TABLE IF EXISTS Country CASCADE;
DROP TABLE IF EXISTS PaymentMethod CASCADE;
DROP TABLE IF EXISTS Campaign CASCADE;
DROP TABLE IF EXISTS MeetingGame CASCADE;
DROP TABLE IF EXISTS Notification CASCADE;
DROP TABLE IF EXISTS LikeNotification CASCADE;
DROP TABLE IF EXISTS ReplyNotification CASCADE;
DROP TABLE IF EXISTS FriendRequestNotification CASCADE;
DROP TABLE IF EXISTS CommentReplyNotification CASCADE;
DROP TABLE IF EXISTS TextContentReplyNotification CASCADE;
DROP TABLE IF EXISTS GameSession CASCADE;
DROP TABLE IF EXISTS GameStats CASCADE;

SET Search.path lbaw2121;
-----------------------------------------
-- Types
-----------------------------------------



-----------------------------------------
-- Tables
-----------------------------------------

CREATE TABLE Users (
   id SERIAL PRIMARY KEY,
   username TEXT NOT NULL UNIQUE,
   name TEXT NOT NULL,
   email TEXT NOT NULL UNIQUE,
   hashed_password TEXT NOT NULL,
   profile_picture TEXT NOT NULL,
   cover_picture TEXT NOT NULL, 
   phone_number TEXT,
   id_country INTEGER NOT NULL REFERENCES Country(id) ON UPDATE CASCADE, 
   birthday TIMESTAMP WITH TIME ZONE NOT NULL
);

CREATE TABLE AdminUser ( 
   id_user INTEGER PRIMARY KEY REFERENCES Users(id) ON UPDATE CASCADE
);

CREATE TABLE Advertiser (
   id_user INTEGER PRIMARY KEY REFERENCES Users(id) ON UPDATE CASCADE, 
   company_name TEXT NOT NULL,
   id_wallet INTEGER NOT NULL REFERENCES Wallet(id) NOT NULL
);

CREATE TABLE Wallet (
   id SERIAL PRIMARY KEY,
   budget FLOAT NOT NULL,
   CONSTRAINT CHK_budget CHECK (budget >= 0.0)
);

CREATE TABLE Content (
   id SERIAL PRIMARY KEY,
   publishing_date TIMESTAMP WITH TIME ZONE NOT NULL,
   id_group INTEGER REFERENCES Groups(id) ON UPDATE CASCADE,
   id_creator INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE
);

CREATE TABLE ContentLike (
   date TIMESTAMP WITH TIME ZONE NOT NULL,
   id_user INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE,
   id_content INTEGER NOT NULL REFERENCES Content(id),
   CONSTRAINT PK_ContentLike PRIMARY KEY (id_user, id_content)
);

CREATE TABLE TextContent ( 
   id SERIAL PRIMARY KEY,
   post_text TEXT NOT NULL,
   id_content INTEGER NOT NULL REFERENCES Content(id) ON UPDATE CASCADE
);

CREATE TABLE TextReply (
   child_text INTEGER PRIMARY KEY REFERENCES TextContent(id) ON UPDATE CASCADE,
   parent_text INTEGER NOT NULL REFERENCES TextContent(id) ON UPDATE CASCADE
);

CREATE TABLE MediaContent (
   id SERIAL PRIMARY KEY,
   description TEXT NOT NULL,
   media TEXT NOT NULL,
   fullscreen BOOLEAN NOT NULL,
   id_content INTEGER NOT NULL REFERENCES Content(id) ON UPDATE CASCADE,
   id_locale INTEGER REFERENCES Locale(id) ON UPDATE CASCADE
);

CREATE TABLE Video (
   id SERIAL PRIMARY KEY,
   alt_text TEXT NOT NULL,
   views INTEGER NOT NULL,        
   id_media_content INTEGER NOT NULL REFERENCES MediaContent(id) ON UPDATE CASCADE,
   CONSTRAINT CHK_size CHECK (size > 0.0) 
);

CREATE TABLE Image (
   id SERIAL PRIMARY KEY,
   alt_text TEXT NOT NULL,
   width INTEGER,
   height INTEGER,
   id_media_content INTEGER NOT NULL REFERENCES MediaContent(id) ON UPDATE CASCADE,
   CONSTRAINT CHK_width CHECK (width > 0.0),
   CONSTRAINT CHK_heigh CHECK (height > 0.0)
);

CREATE TABLE Comment (
   id SERIAL PRIMARY KEY,
   comment_text TEXT NOT NULL,
   comment_date TIMESTAMP WITH TIME ZONE NOT NULL,
   author INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE,
   id_media_content INTEGER NOT NULL REFERENCES MediaContent(id) ON UPDATE CASCADE
);

CREATE TABLE FriendRequest (
   id SERIAL PRIMARY KEY,
   creation TIMESTAMP WITH TIME ZONE NOT NULL,
   id_sender INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE,
   id_receiver INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE
);

CREATE TABLE AcceptedFriendRequest (
   id_friend_request INTEGER PRIMARY KEY REFERENCES FriendRequest(id) ON UPDATE CASCADE,
   accepted_date TIMESTAMP WITH TIME ZONE NOT NULL
);

CREATE TABLE RejectedFriendRequest (
   id_friend_request INTEGER PRIMARY KEY REFERENCES FriendRequest(id) ON UPDATE CASCADE,
   rejected_date TIMESTAMP WITH TIME ZONE NOT NULL
);

CREATE TABLE Message (  -- Maybe do MessageGroup in future
   id SERIAL PRIMARY KEY,
   message TEXT NOT NULL,
   id_user_sender INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE,
   id_user_receiver INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE,
   publish_date TIMESTAMP WITH TIME ZONE NOT NULL
);

CREATE TABLE Groups (
   id SERIAL PRIMARY KEY,
   name TEXT NOT NULL,
   description TEXT
);

CREATE TABLE UserGroupModerator (
   id_group INTEGER NOT NULL REFERENCES Groups(id) ON UPDATE CASCADE,
   id_user_moderator INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE,
   PRIMARY KEY (id_group, id_user_moderator)
);

CREATE TABLE UserGroupMember (
   id_group INTEGER NOT NULL REFERENCES Groups(id) ON UPDATE CASCADE,
   id_user_member INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE,
   PRIMARY KEY (id_group, id_user_member)
);

CREATE TABLE Interest (
   id SERIAL PRIMARY KEY,
   name TEXT NOT NULL,
   description TEXT NOT NULL
);

CREATE TABLE InterestUser (
   id_interest INTEGER NOT NULL REFERENCES Interest(id) ON UPDATE CASCADE,
   id_user INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE,
   PRIMARY KEY (id_interest, id_user)
);

CREATE TABLE Locale ( 
   id SERIAL PRIMARY KEY,
   region TEXT NOT NULL,
   id_country INTEGER NOT NULL REFERENCES Locale(id) ON UPDATE CASCADE
);

CREATE TABLE Country (
   id SERIAL PRIMARY KEY,
   iso_3166 TEXT UNIQUE,
   name TEXT NOT NULL
);

CREATE TABLE Notification (
   id SERIAL PRIMARY KEY,
   id_user INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE,
   read BOOLEAN
);

CREATE TABLE LikeNotification (
   id_notification INTEGER PRIMARY KEY REFERENCES Notification(id) ON UPDATE CASCADE,
   id_like INTEGER NOT NULL REFERENCES ContentLike(id) ON UPDATE CASCADE
);

CREATE TABLE ReplyNotification (
   id_notification INTEGER PRIMARY KEY REFERENCES Notification(id) ON UPDATE CASCADE
);

CREATE TABLE FriendRequestNotification (
   id_notification INTEGER PRIMARY KEY REFERENCES Notification(id) ON UPDATE CASCADE,
   id_friend_request INTEGER NOT NULL REFERENCES FriendRequest(id) ON UPDATE CASCADE 
);

CREATE TABLE CommentReplyNotification (
   id_reply_notification INTEGER PRIMARY KEY REFERENCES ReplyNotification(id_notification) ON UPDATE CASCADE,
   id_comment INTEGER NOT NULL REFERENCES Comment(id) ON UPDATE CASCADE
);

CREATE TABLE TextContentReplyNotification (
   id_reply_notification INTEGER PRIMARY KEY REFERENCES ReplyNotification(id_notification) ON UPDATE CASCADE,
   id_text_content INTEGER NOT NULL REFERENCES TextContent(id) ON UPDATE CASCADE
);

CREATE TABLE PaymentMethod (
   id SERIAL PRIMARY KEY,
   name TEXT NOT NULL,
   company TEXT NOT NULL,
   transaction_limit FLOAT,
   CONSTRAINT CHK_limit CHECK (transation_limit >= 0.0)
);

CREATE TABLE Campaign (
   id_media_content INTEGER PRIMARY KEY REFERENCES MediaContent(id) ON UPDATE CASCADE,
   id_advertiser INTEGER NOT NULL REFERENCES Advertiser(id) ON UPDATE CASCADE,
   starting_date TIMESTAMP WITH TIME ZONE NOT NULL,
   finishing_date TIMESTAMP WITH TIME ZONE NOT NULL,
   budget FLOAT,
   remaining_budget FLOAT,
   impressions INTEGER,
   clicks INTEGER,
   CONSTRAINT CHK_campaign_dates CHECK (finishing_date > starting_date),
   CONSTRAINT CHK_campaign_budgets CHECK (remaining_budget <= budget)
);

CREATE TABLE GameSession (
   id SERIAL PRIMARY KEY,
   session_title TEXT NOT NULL
);

CREATE TABLE GameStats (
   id_user INTEGER PRIMARY KEY REFERENCES Users(id) ON UPDATE CASCADE,
   id_game_session INTEGER NOT NULL REFERENCES GameSession(id) ON UPDATE CASCADE,
   score INTEGER NOT NULL
);
