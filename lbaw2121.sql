-----------------------------------------
-- Drop old schema
-----------------------------------------

DROP TABLE IF EXISTS User CASCADE;
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
DROP TABLE IF EXISTS Message CASCADE;
DROP TABLE IF EXISTS MessageUser CASCADE;
DROP TABLE IF EXISTS Group CASCADE;
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

DROP TYPE IF EXISTS video_quality CASCADE;

SET Search.path lbaw2121;
-----------------------------------------
-- Types
-----------------------------------------

CREATE TYPE video_quality AS ENUM ('480p', '720p', '1080p')

-----------------------------------------
-- Tables
-----------------------------------------

-- Note that a plural 'users' name was adopted because user is a reserved word in PostgreSQL.
CREATE TABLE User (
   id SERIAL PRIMARY KEY,
   username TEXT UNIQUE NOT NULL,
   name TEXT NOT NULL,
   email TEXT NOT NULL UNIQUE,
   hashed_password TEXT NOT NULL,
   profile_picture TEXT, --Path can be null it means default photo?
   cover_picture TEXT, --Path
   phone_number TEXT,
   id_advertiser_user INTEGER NOT NULL REFERENCES Advertiser(id) ON UPDATE CASCADE,
   id_admin_user INTEGER NOT NULL REFERENCES AdminUser(id) ON UPDATE CASCADE, 
   id_country INTEGER NOT NULL REFERENCES Country(id) ON UPDATE CASCADE, 
   birthday TIMESTAMP WITH TIME ZONE NOT NULL
);

CREATE TABLE AdminUser {  -- because admin is a reserved word
   id SERIAL PRIMARY KEY, 
};

CREATE TABLE Advertiser (
   id SERIAL PRIMARY KEY,
   company_name TEXT NOT NULL,
   id_wallet INTEGER FOREIGN KEY REFERENCES Wallet(id) NOT NULL,
);

CREATE TABLE Wallet (
   id SERIAL PRIMARY KEY,
   CONSTRAINT CHK_budget CHECK (budget >= 0.0)
);

CREATE TABLE Content (
   id SERIAL PRIMARY KEY,
   publishing_date TIMESTAMP WITH TIME ZONE NOT NULL,
   id_group INTEGER REFERENCES Group(id) ON UPDATE CASCADE,
   id_creator INTEGER NOT NULL REFERENCES User(id) ON UPDATE CASCADE
);

CREATE TABLE ContentLike (
   date DATE NOT NULL,
   id_user INTEGER NOT NULL REFERENCES User(id) ON UPDATE CASCADE,
   id_content INTEGER NOT NULL REFERENCES Content(id),
   CONSTRAINT PK_ContentLike PRIMARY KEY (id_user, id_content)
);

CREATE TABLE TextContent (  -- text reserved word
   id SERIAL SERIAL PRIMARY KEY,
   post_text TEXT NOT NULL,
   id_content INTEGER NOT NULL REFERENCES Content(id) ON UPDATE CASCADE
);

CREATE TABLE TextReply (
   parent_text INTEGER NOT NULL REFERENCES TextContent(id) ON UPDATE CASCADE,
   child_text INTEGER PRIMARY KEY REFERENCES TextContent(id) ON UPDATE CASCADE
);

CREATE TABLE MediaContent (
   id SERIAL PRIMARY KEY,
   description TEXT NOT NULL,
   media TEXT NOT NULL, --Path
   fullscreen BOOLEAN, -- when null -> false
   id_content INTEGER NOT NULL REFERENCES Content(id) ON UPDATE CASCADE,
   id_locale INTEGER REFERENCES Locale(id) ON UPDATE CASCADE
);

CREATE TABLE Video (
   id SERIAL PRIMARY KEY,
   title TEXT NOT NULL,
   size INTEGER,  --number of seconds?
   quality VIDEO_QUALITY,
   views INTEGER,         -- SHOULDN'T IT BE A RELATION TO USER
   id_media_content INTEGER NOT NULL REFERENCES MediaContent(id) ON UPDATE CASCADE,
   CONSTRAINT CHK_size CHECK (size > 0.0)  --MISSING FOREIGN KEYS
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
   comment_date TIMESTAMP WITH TIME ZONE NOT NULL
   author INTEGER NOT NULL REFERENCES User(id) ON UPDATE CASCADE,
   id_media_content INTEGER NOT NULL REFERENCES MediaContent(id) ON UPDATE CASCADE
);

CREATE TABLE FriendRequest (  -- id??
   creation DATE NOT NULL,
   state INT,  -- for not answered/accepted/rejected
   id_user_from INTEGER NOT NULL REFERENCES User(id) ON UPDATE CASCADE,
   id_user_to INTEGER NOT NULL REFERENCES User(id) ON UPDATE CASCADE,
   CONSTRAINT PK_FriendRequest PRIMARY KEY (id_user_from, id_user_to)
);

CREATE TABLE Message (
   id SERIAL PRIMARY KEY,
   message TEXT NOT NULL,
   id_user_sender INTEGER NOT NULL REFERENCES User(id) ON UPDATE CASCADE,
   publish_date DATE
);

CREATE TABLE MessageUser (
   id_message INTEGER NOT NULL REFERENCES Message(id) ON UPDATE CASCADE,
   id_user_receiver INTEGER NOT NULL REFERENCES User(id) ON UPDATE CASCADE
);

CREATE TABLE Group (
   id SERIAL PRIMARY KEY,
   name TEXT NOT NULL,
   description TEXT
);

CREATE TABLE UserGroupModerator (
   id_group INTEGER NOT NULL REFERENCES Group(id) ON UPDATE CASCADE,
   id_user_moderator INTEGER NOT NULL REFERENCES User(id) ON UPDATE CASCADE
);

CREATE TABLE UserGroupMember (
   id_group INTEGER NOT NULL REFERENCES Group(id) ON UPDATE CASCADE,
   id_user_member INTEGER NOT NULL REFERENCES User(id) ON UPDATE CASCADE
);

CREATE TABLE Interest (
   id SERIAL PRIMARY KEY,
   name TEXT NOT NULL,
   description TEXT NOT NULL,
);

CREATE TABLE InterestUser (
   id_interest INTEGER NOT NULL REFERENCES Interest(id) ON UPDATE CASCADE,
   id_user INTEGER NOT NULL REFERENCES User(id) ON UPDATE CASCADE
);

CREATE TABLE Locale (  -- location seems it is reserved word change it?
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
   id_user INTEGER NOT NULL REFERENCES User(id) ON UPDATE CASCADE,
   read BOOLEAN
);

CREATE TABLE LikeNotification (
   id_notification INTEGER PRIMARY KEY REFERENCES Notification(id) ON UPDATE CASCADE,
   id_like INTEGER NOT NULL REFERENCES ContentLike(id) ON UPDATE CASCADE,
);

CREATE TABLE ReplyNotification (
   id_notification INTEGER PRIMARY KEY REFERENCES Notification(id) ON UPDATE CASCADE,
);

CREATE TABLE FriendRequestNotification (
   id_notification INTEGER PRIMARY KEY REFERENCES Notification(id) ON UPDATE CASCADE,
   id_friend_request INTEGER NOT NULL REFERENCES FriendRequest(id) ON UPDATE CASCADE  -- friend request does not has id!! see later
);

CREATE TABLE CommentReplyNotification (
   id_reply_notification INTEGER NOT NULL REFERENCES ReplyNotification(id_notification) ON UPDATE CASCADE,
   id_comment INTEGER NOT NULL REFERENCES Comment(id) ON UPDATE CASCADE
);

CREATE TABLE TextContentReplyNotification (
   id_reply_notification INTEGER NOT NULL REFERENCES ReplyNotification(id_notification) ON UPDATE CASCADE,
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
   id SERIAL PRIMARY KEY,
   starting_date TIMESTAMP WITH TIME ZONE NOT NULL,
   finishing_date TIMESTAMP WITH TIME ZONE NOT NULL,
   budget FLOAT,
   remaining_budget FLOAT,
   impressions INTEGER,
   clicks INTEGER,
   id_advertiser INTEGER NOT NULL REFERENCES Advertiser(id) ON UPDATE CASCADE,  -- media content could be the primary key, as it stands in the many side
   id_media_content INTEGER NOT NULL REFERENCES MediaContent(id) ON UPDATE CASCADE,
   CONSTRAINT CHK_campaign_dates CHECK (finishing_date > starting_date),
   CONSTRAINT CHK_campaign_budgets CHECK (remaining_budget <= budget)
);

CREATE TABLE GameSession (
   id SERIAL PRIMARY KEY,
   session_title TEXT NOT NULL,
   name TEXT NOT NULL,
);

CREATE TABLE Stats (
   score INTEGER NOT NULL,
   id_user INTEGER PRIMARY KEY REFERENCES User(id) ON UPDATE CASCADE,
   id_game_session INTEGER NOT NULL REFERENCES GameSession(id) ON UPDATE CASCADE
);

/*
CREATE TABLE work (
   id SERIAL PRIMARY KEY,
   title TEXT NOT NULL,
   obs TEXT,
   img TEXT,
   year INTEGER,
   id_users INTEGER REFERENCES users (id) ON UPDATE CASCADE,
   id_collection INTEGER REFERENCES collection (id) ON UPDATE CASCADE,
   CONSTRAINT year_positive_ck CHECK ((year > 0))
);

CREATE TABLE author_work (
   id_author INTEGER NOT NULL REFERENCES author (id) ON UPDATE CASCADE,
   id_work INTEGER NOT NULL REFERENCES work (id) ON UPDATE CASCADE,
   PRIMARY KEY (id_author, id_work)
);

CREATE TABLE book (
   id_work INTEGER PRIMARY KEY REFERENCES work (id) ON UPDATE CASCADE,
   edition TEXT,
   isbn BIGINT NOT NULL CONSTRAINT book_isbn_uk UNIQUE,
   id_publisher INTEGER REFERENCES publisher (id) ON UPDATE CASCADE
);

CREATE TABLE nonbook (
   id_work INTEGER PRIMARY KEY REFERENCES work (id) ON UPDATE CASCADE ON DELETE CASCADE,
   TYPE media NOT NULL
);

CREATE TABLE item (
   id SERIAL PRIMARY KEY,
   id_work INTEGER NOT NULL REFERENCES work (id) ON UPDATE CASCADE,
   id_location INTEGER NOT NULL REFERENCES location (id) ON UPDATE CASCADE,
   code INTEGER NOT NULL,
   date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL
);

CREATE TABLE loan (
   id SERIAL PRIMARY KEY,
   id_item INTEGER NOT NULL REFERENCES item (id) ON UPDATE CASCADE,
   id_users INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
   start_t TIMESTAMP WITH TIME ZONE NOT NULL,
   end_t TIMESTAMP WITH TIME ZONE NOT NULL,
   CONSTRAINT date_ck CHECK (end_t > start_t)
);

CREATE TABLE review (
   id_work INTEGER NOT NULL REFERENCES work (id) ON UPDATE CASCADE,
   id_users INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
   date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
   comment TEXT NOT NULL,
   rating INTEGER NOT NULL CONSTRAINT rating_ck CHECK (((rating > 0) OR (rating <= 5))),
   PRIMARY KEY (id_work, id_users)
);

CREATE TABLE wish_list (
   id_work INTEGER NOT NULL REFERENCES work (id) ON UPDATE CASCADE,
   id_users INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
   PRIMARY KEY (id_work, id_users)
);
*/






