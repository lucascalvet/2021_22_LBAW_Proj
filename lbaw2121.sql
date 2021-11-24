SET Search.path lbaw2121;
-----------------------------------------
-- Types
-----------------------------------------

--CREATE TYPE media AS ENUM ('CD', 'DVD', 'VHS', 'Slides', 'Photos', 'MP3');
CREATE TYPE video_quality AS ENUM ('480p', '720p', '1080')

-----------------------------------------
-- Tables
-----------------------------------------


-- Note that a plural 'users' name was adopted because user is a reserved word in PostgreSQL.
CREATE TABLE User (
   id SERIAL PRIMARY KEY,
   username TEXT UNIQUE NOT NULL,
   name TEXT NOT NULL,
   email TEXT NOT NULL CONSTRAINT user_email_uk UNIQUE,
   hashed_password TEXT NOT NULL,
   profile_picture TEXT NOT NULL, --Path
   cover_picture TEXT NOT NULL, --Path
   phone_number TEXT,
   advertiser BIGINT,
   FOREIGN KEY (advertiser) REFERENCES Advertiser(id),   
   birthday TIMESTAMP WITH TIME ZONE NOT NULL
);

CREATE TABLE Advertiser (
   id SERIAL PRIMARY KEY,
   company_name TEXT NOT NULL,
   wallet INTEGER FOREIGN KEY REFERENCES Wallet(id) NOT NULL,
);

CREATE TABLE Wallet (
   id SERIAL PRIMARY KEY,
   CONSTRAINT CHK_budget CHECK (budget >= 0.0)
);

CREATE TABLE Content (
   id SERIAL PRIMARY KEY,
   number_likes INTEGER,
   publishing_date TIMESTAMP WITH TIME ZONE NOT NULL,
   creator TEXT NOT NULL REFERENCES User(username) ON UPDATE CASCADE
);

CREATE TABLE Group (
   id SERIAL PRIMARY KEY,
   name TEXT NOT NULL,
   description TEXT
);

CREATE TABLE Comment (
   id SERIAL PRIMARY KEY,
   comment_text TEXT NOT NULL,
   comment_date TIMESTAMP WITH TIME ZONE NOT NULL
);

CREATE TABLE Interest (
   id SERIAL PRIMARY KEY,
   name TEXT NOT NULL,
   description TEXT NOT NULL,
);

CREATE TABLE MediaContent (
   id SERIAL PRIMARY KEY,
   description TEXT NOT NULL,
   media TEXT NOT NULL, --Path
   fullscreen BOOLEAN
);

CREATE TABLE Message (
   id SERIAL PRIMARY KEY,
   message TEXT NOT NULL,
   publish_date DATE
);

CREATE TABLE PaymentMethod (
   id SERIAL PRIMARY KEY,
   name TEXT NOT NULL PRIMARY KEY,
   company TEXT NOT NULL,
   transaction_limit FLOAT,
   CONSTRAINT CHK_limit CHECK (transation_limit >= 0.0)
);

CREATE TABLE FriendRequest (
   user_from TEXT,
   user_to TEXT,
   creation DATE NOT NULL,
   state INT,  -- for not answered/accepted/rejected
   CONSTRAINT PK_FriendRequest PRIMARY KEY (user_from,user_to)
);

CREATE TABLE Location (
   id SERIAL PRIMARY KEY,
   region TEXT NOT NULL,
   --address TEXT NOT NULL,
   --gps TEXT
);

CREATE TABLE Country (
   iso_3166 TEXT NOT NULL UNIQUE ,
   name TEXT,
   CONSTRAINT PRIMARY KEY (iso_3166)
);

CREATE TABLE ContentLikes (
   id_user TEXT NOT NULL REFERENCES User(usename) ON UPDATE CASCADE,
   id_content INTEGER NOT NULL REFERENCES Content(id),
   date DATE,
   PRIMARY KEY (id_user, id_content)
);

CREATE TABLE Notification (
   id_notification SERIAL PRIMARY KEY,
   read BOOLEAN
);

CREATE TABLE Text(
   id_text SERIAL SERIAL PRIMARY KEY,
   post_text TEXT NOT NULL 
);

CREATE TABLE Video(
   id_video SERIAL SERIAL PRIMARY KEY,
   title TEXT NOT NULL,
   size INTEGER,  --number of seconds?
   quality VIDEO_QUALITY,
   views INTEGER,
   CONSTRAINT CHK_size CHECK (size > 0.0)
);

CREATE TABLE Image(
   id_image SERIAL PRIMARY KEY,
   title TEXT NOT NULL,
   width INTEGER,
   height INTEGER,
   CONSTRAINT CHK_width CHECK (width > 0.0),
   CONSTRAINT CHK_heigh CHECK (height > 0.0)
);

CREATE TABLE Campaign(
   id_campaign SERIAL PRIMARY KEY,
   starting_date TIMESTAMP WITH TIME ZONE NOT NULL,
   finishing_date TIMESTAMP WITH TIME ZONE NOT NULL,
   budget FLOAT,
   remaining_budget FLOAT,
   impressions INTEGER,
   clicks INTEGER,
   CONSTRAINT CHK_campaign_dates CHECK (finishing_date > starting_date),
   CONSTRAINT CHK_campaign_budgets CHECK (remaining_budget <= budget)
);

CREATE TABLE MeetingGame (
   id SERIAL PRIMARY KEY,
   name TEXT NOT NULL,
   Type TEXT
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






