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
DROP TABLE IF EXISTS Groups CASCADE;
DROP TABLE IF EXISTS UserGroupModerator CASCADE;
DROP TABLE IF EXISTS UserGroupMember CASCADE;
DROP TABLE IF EXISTS Interest CASCADE;
DROP TABLE IF EXISTS InterestUser CASCADE;
DROP TABLE IF EXISTS Locale CASCADE;
DROP TABLE IF EXISTS Country CASCADE;
DROP TABLE IF EXISTS PaymentMethod CASCADE;
DROP TABLE IF EXISTS Campaign CASCADE;
DROP TABLE IF EXISTS Notification CASCADE;
DROP TABLE IF EXISTS LikeNotification CASCADE;
DROP TABLE IF EXISTS ReplyNotification CASCADE;
DROP TABLE IF EXISTS FriendRequestNotification CASCADE;
DROP TABLE IF EXISTS CommentReplyNotification CASCADE;
DROP TABLE IF EXISTS TextContentReplyNotification CASCADE;
DROP TABLE IF EXISTS GameSession CASCADE;
DROP TABLE IF EXISTS GameStats CASCADE;
DROP TABLE IF EXISTS Friends CASCADE;
DROP FUNCTION IF EXISTS dateComment CASCADE;
DROP FUNCTION IF EXISTS dateText CASCADE;
DROP FUNCTION IF EXISTS textreply_search_update CASCADE;
DROP FUNCTION IF EXISTS mediacontent_search_update CASCADE;

SET Search.path TO lbaw2121;
-----------------------------------------
-- Types
-----------------------------------------


-----------------------------------------
-- Tables
-----------------------------------------

CREATE TABLE Country (
   id SERIAL PRIMARY KEY,
   iso_3166 TEXT UNIQUE,
   name TEXT NOT NULL
);

CREATE TABLE Users (
   id SERIAL PRIMARY KEY,
   username TEXT NOT NULL UNIQUE,
   name TEXT NOT NULL,
   email TEXT NOT NULL UNIQUE,
   hashed_password TEXT NOT NULL,
   profile_picture TEXT,
   cover_picture TEXT,
   phone_number TEXT,
   id_country INTEGER NOT NULL REFERENCES Country(id) ON UPDATE CASCADE, 
   birthday TIMESTAMP WITH TIME ZONE NOT NULL
);

CREATE TABLE AdminUser ( 
   id_user INTEGER PRIMARY KEY REFERENCES Users(id) ON UPDATE CASCADE
);

CREATE TABLE Wallet (
   id SERIAL PRIMARY KEY,
   budget FLOAT NOT NULL,
   CONSTRAINT CHK_budget CHECK (budget >= 0.0)
);

CREATE TABLE Advertiser (
   id_user INTEGER PRIMARY KEY REFERENCES Users(id) ON UPDATE CASCADE, 
   company_name TEXT NOT NULL,
   id_wallet INTEGER NOT NULL REFERENCES Wallet(id) NOT NULL
);

CREATE TABLE Groups (
   id SERIAL PRIMARY KEY,
   name TEXT NOT NULL,
   description TEXT
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

CREATE TABLE Locale ( 
   id SERIAL PRIMARY KEY,
   region TEXT NOT NULL,
   id_country INTEGER NOT NULL REFERENCES Country(id) ON UPDATE CASCADE
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
   id_media_content INTEGER NOT NULL REFERENCES MediaContent(id) ON UPDATE CASCADE
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

CREATE TABLE Message (
   id SERIAL PRIMARY KEY,
   text TEXT NOT NULL,
   id_user_sender INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE,
   id_user_receiver INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE,
   msg_date TIMESTAMP WITH TIME ZONE NOT NULL
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

CREATE TABLE Notification (
   id SERIAL PRIMARY KEY,
   id_user INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE,
   read BOOLEAN NOT NULL
);

CREATE TABLE LikeNotification (
   id_notification INTEGER PRIMARY KEY REFERENCES Notification(id) ON UPDATE CASCADE,
   id_user INTEGER NOT NULL,
   id_content INTEGER NOT NULL,
   FOREIGN KEY (id_user, id_content) REFERENCES ContentLike(id_user, id_content) ON UPDATE CASCADE
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
   transaction_limit FLOAT NOT NULL,
   CONSTRAINT CHK_limit CHECK (transaction_limit > 0.0)
);

CREATE TABLE Campaign (
   id_media_content INTEGER PRIMARY KEY REFERENCES MediaContent(id) ON UPDATE CASCADE,
   id_advertiser INTEGER NOT NULL REFERENCES Advertiser(id_user) ON UPDATE CASCADE,
   starting_date TIMESTAMP WITH TIME ZONE NOT NULL,
   finishing_date TIMESTAMP WITH TIME ZONE NOT NULL,
   budget FLOAT NOT NULL,
   remaining_budget FLOAT NOT NULL,
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

CREATE TABLE Friends (
   id_user1 INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE,
   id_user2 INTEGER NOT NULL REFERENCES Users(id) ON UPDATE CASCADE,
   PRIMARY KEY (id_user1, id_user2),
   CONSTRAINT CHK_friends CHECK (id_user1 > id_user2) 
);


--------------------------------------------
--INDEX
--------------------------------------------
--Performance Indeces

CREATE INDEX user_content ON Content USING hash (id_creator);

CREATE INDEX mediacontent_location ON MediaContent USING btree (id_locale);
CLUSTER MediaContent USING mediacontent_location;

CREATE INDEX end_campaign ON Campaign USING btree (finishing_date);


--Full Text Search Indeces

-- Add column to TextReply to store computed ts_vectors.
ALTER TABLE TextReply
ADD COLUMN tsvectors TSVECTOR;

-- Create a function to automatically update ts_vectors.
CREATE FUNCTION textreply_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
         setweight(to_tsvector('english', (SELECT post_text FROM TextContent WHERE id = NEW.child_text)), 'A') ||
         setweight(to_tsvector('english', (SELECT post_text FROM TextContent WHERE id = NEW.parent_text)), 'B')
        );
 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.child_text <> OLD.child_text OR NEW.parent_text <> OLD.parent_text) THEN
           NEW.tsvectors = (
             setweight(to_tsvector('english', (SELECT post_text FROM TextContent WHERE id = NEW.child_text)), 'A') ||
             setweight(to_tsvector('english', (SELECT post_text FROM TextContent WHERE id = NEW.parent_text)), 'B')
           );
         END IF;
 END IF;
 RETURN NEW;
END $$
LANGUAGE plpgsql;

-- Create a trigger before insert or update on TextReply.
CREATE TRIGGER textreply_search_update
 BEFORE INSERT OR UPDATE ON TextReply
 FOR EACH ROW
 EXECUTE PROCEDURE textreply_search_update();

-- Finally, create a GIN index for ts_vectors.
CREATE INDEX tr_search_idx ON TextReply USING GIN (tsvectors);


-- Add column to MediaContent to store computed ts_vectors.
ALTER TABLE MediaContent
ADD COLUMN tsvectors TSVECTOR;

-- Create a function to automatically update ts_vectors.
CREATE FUNCTION mediacontent_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
         setweight(to_tsvector('english', NEW.description), 'A')
        );
 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.description  <> OLD.description) THEN
           NEW.tsvectors = (
             setweight(to_tsvector('english', NEW.description), 'A')
           );
         END IF;
 END IF;
 RETURN NEW;
END $$
LANGUAGE plpgsql;

-- Create a trigger before insert or update on MediaContent.
CREATE TRIGGER mediacontent_search_update
 BEFORE INSERT OR UPDATE ON MediaContent
 FOR EACH ROW
 EXECUTE PROCEDURE mediacontent_search_update();

-- Finally, create a GIN index for ts_vectors.
CREATE INDEX mc_search_idx ON TextReply USING GIN (tsvectors);

--------------------------------------------
--TRIGGERS
--------------------------------------------
--TRIGGER 1

CREATE FUNCTION dateComment() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF ((SELECT publishing_date FROM Content WHERE id = NEW.id_media_content)> NEW.comment_date) THEN RAISE EXCEPTION 'Content date greater than Comment date';
   END IF;
   RETURN NEW;
END;
$$;

CREATE TRIGGER DateComment
   BEFORE INSERT ON Comment
   FOR EACH ROW
   EXECUTE PROCEDURE dateComment();


--TRIGGER 2

CREATE FUNCTION dateText() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF ((SELECT publishing_date FROM Content WHERE id = (SELECT id_content FROM TextContent WHERE id = NEW.child_text)) <= (SELECT publishing_date FROM Content WHERE id = (SELECT id_content FROM TextContent WHERE id = NEW.parent_text))) THEN RAISE EXCEPTION 'Parent reply date greater than child date';
   END IF;
   RETURN NEW;
END;
$$;

CREATE TRIGGER DateText
   BEFORE INSERT ON TextReply
   FOR EACH ROW
   EXECUTE PROCEDURE dateText();



--------------------------------------------
--TRANSACTIONS
--------------------------------------------
--TRANSACTION 1
BEGIN TRANSACTION;

SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;

-- Get the number of text posts
SELECT COUNT(*)
FROM TextContent;

-- Get the last 50 text posts
SELECT username, publishing_date, post_text
FROM TextContent
INNER JOIN Content ON Content.id = TextContent.id_content
INNER JOIN Users ON Users.id = Content.id_creator
ORDER BY Content.publishing_date DESC
LIMIT 50;

END TRANSACTION;


--TRANSACTION 2
BEGIN TRANSACTION;

SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;

-- Insert MediaContent
INSERT INTO MediaContent (description, media, fullscreen, id_content, id_locale) 
 VALUES ($description, $media, $fullscreen, $id_content, $id_locale) ;

-- Insert Video
INSERT INTO Video (alt_text, views, id_media_content) 
 VALUES ($alt_text, $views, currval(id_media_content_seq))

END TRANSACTION;


