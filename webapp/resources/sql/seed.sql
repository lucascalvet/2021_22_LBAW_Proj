DROP SCHEMA IF EXISTS lbaw2121 CASCADE;
CREATE SCHEMA lbaw2121;
SET Search_path TO lbaw2121;

-----------------------------------------
-- Drop old schema
-----------------------------------------

DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS admin_user CASCADE;
DROP TABLE IF EXISTS advertiser CASCADE;
DROP TABLE IF EXISTS wallet CASCADE;
DROP TABLE IF EXISTS content CASCADE;
DROP TABLE IF EXISTS content_like CASCADE;
DROP TABLE IF EXISTS text_content CASCADE;
DROP TABLE IF EXISTS text_reply CASCADE;
DROP TABLE IF EXISTS media_content CASCADE;
DROP TABLE IF EXISTS video CASCADE;
DROP TABLE IF EXISTS image CASCADE;
DROP TABLE IF EXISTS comment CASCADE;
DROP TABLE IF EXISTS friend_request CASCADE;
DROP TABLE IF EXISTS accepted_friend_request CASCADE;
DROP TABLE IF EXISTS rejected_friend_request CASCADE;
/*DROP TABLE IF EXISTS message CASCADE;*/
DROP TABLE IF EXISTS groups CASCADE;
DROP TABLE IF EXISTS group_moderator CASCADE;
DROP TABLE IF EXISTS group_member CASCADE;
DROP TABLE IF EXISTS interest CASCADE;
/*DROP TABLE IF EXISTS user_interest CASCADE;*/
DROP TABLE IF EXISTS locale CASCADE;
DROP TABLE IF EXISTS country CASCADE;
DROP TABLE IF EXISTS payment_method CASCADE;
/*DROP TABLE IF EXISTS campaign CASCADE;*/
DROP TABLE IF EXISTS notification CASCADE;
DROP TABLE IF EXISTS like_notification CASCADE;
DROP TABLE IF EXISTS reply_notification CASCADE;
DROP TABLE IF EXISTS friend_request_notification CASCADE;
DROP TABLE IF EXISTS comment_notification CASCADE;
DROP TABLE IF EXISTS text_content_reply_notification CASCADE;
DROP TABLE IF EXISTS game_session CASCADE;
/*DROP TABLE IF EXISTS game_stats CASCADE;*/
DROP TABLE IF EXISTS friends CASCADE;
DROP FUNCTION IF EXISTS comment_date CASCADE;
DROP FUNCTION IF EXISTS text_date CASCADE;
DROP FUNCTION IF EXISTS textreply_search_update CASCADE;
DROP FUNCTION IF EXISTS media_content_search_update CASCADE;

-----------------------------------------
-- Types
-----------------------------------------


-----------------------------------------
-- Tables
-----------------------------------------

CREATE TABLE country (
   id SERIAL PRIMARY KEY,
   iso_3166 TEXT  CONSTRAINT country_iso_3166_uk UNIQUE,
   name TEXT NOT NULL
);

-- user is a reserved word in PostgreSQL.
CREATE TABLE users (
   id SERIAL PRIMARY KEY,
   username TEXT NOT NULL CONSTRAINT user_username_uk UNIQUE,
   name TEXT NOT NULL,
   email TEXT NOT NULL CONSTRAINT user_email_uk UNIQUE,
   hashed_password TEXT NOT NULL,
   profile_picture TEXT,
   cover_picture TEXT,
   phone_number TEXT,
   id_country INTEGER NOT NULL REFERENCES country(id) ON UPDATE CASCADE,
   birthday TIMESTAMP WITH TIME ZONE NOT NULL,
   description TEXT,
   remember_token TEXT
);

CREATE TABLE admin_user (
   id_user INTEGER PRIMARY KEY REFERENCES users(id) ON UPDATE CASCADE
);

CREATE TABLE wallet (
   id SERIAL PRIMARY KEY,
   budget FLOAT NOT NULL,
   CONSTRAINT budget_ck CHECK (budget >= 0.0)
);

/*
CREATE TABLE advertiser (
   id_user INTEGER PRIMARY KEY REFERENCES users(id) ON UPDATE CASCADE,
   company_name TEXT NOT NULL,
   id_wallet INTEGER NOT NULL REFERENCES wallet(id) NOT NULL
);
*/

CREATE TABLE groups (
   id SERIAL PRIMARY KEY,
   private BOOLEAN,
   name TEXT NOT NULL,
   description TEXT
);

CREATE TABLE content (
   id SERIAL PRIMARY KEY,
   publishing_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
   id_group INTEGER REFERENCES groups(id) ON UPDATE CASCADE,
   id_creator INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   contentable_type TEXT
);

CREATE TABLE content_like (
   id SERIAL UNIQUE, --Laravel eloquent does not support composite primary, that's why this id exists
   date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
   id_user INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   id_content INTEGER NOT NULL REFERENCES content(id),
   PRIMARY KEY (id_content, id_user) -- this order is important for retrieving the likes for a certain content
);

CREATE TABLE text_content (
   id_content INTEGER PRIMARY KEY REFERENCES content(id) ON UPDATE CASCADE,
   post_text TEXT NOT NULL
);

CREATE TABLE text_reply (
   child_text INTEGER PRIMARY KEY REFERENCES text_content(id_content) ON UPDATE CASCADE,
   parent_text INTEGER NOT NULL REFERENCES text_content(id_content) ON UPDATE CASCADE
);

CREATE TABLE locale (
   id SERIAL PRIMARY KEY,
   region TEXT NOT NULL,
   id_country INTEGER NOT NULL REFERENCES country(id) ON UPDATE CASCADE
);

CREATE TABLE media_content (
   id_content INTEGER PRIMARY KEY REFERENCES content(id) ON UPDATE CASCADE,
   description TEXT NOT NULL,
   media TEXT NOT NULL,
   alt_text TEXT,
   fullscreen BOOLEAN NOT NULL,
   id_locale INTEGER REFERENCES locale(id) ON UPDATE CASCADE,
   media_contentable_type TEXT
);

CREATE TABLE video (
   id_media_content INTEGER PRIMARY KEY REFERENCES media_content(id_content) ON UPDATE CASCADE,
   title TEXT NOT NULL,
   views INTEGER NOT NULL
);

CREATE TABLE image (
   id_media_content INTEGER PRIMARY KEY REFERENCES media_content(id_content) ON UPDATE CASCADE,
   width INTEGER NOT NULL,
   height INTEGER NOT NULL,
   CONSTRAINT width_ck CHECK (width > 0.0),
   CONSTRAINT heigh_ck CHECK (height > 0.0)
);

CREATE TABLE comment (
   id SERIAL PRIMARY KEY,
   comment_text TEXT NOT NULL,
   comment_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
   id_author INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   id_media_content INTEGER NOT NULL REFERENCES media_content(id_content) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE friend_request (
   id SERIAL PRIMARY KEY,
   creation_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
   id_sender INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   id_receiver INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE accepted_friend_request (
   id_friend_request INTEGER PRIMARY KEY REFERENCES friend_request(id) ON UPDATE CASCADE,
   accepted_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL
);

CREATE TABLE rejected_friend_request (
   id_friend_request INTEGER PRIMARY KEY REFERENCES friend_request(id) ON UPDATE CASCADE,
   rejected_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL
);

/*
CREATE TABLE message (
   id SERIAL PRIMARY KEY,
   text TEXT NOT NULL,
   id_user_sender INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   id_user_receiver INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   msg_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL
);
*/

CREATE TABLE group_moderator (
   id_group INTEGER NOT NULL REFERENCES groups(id) ON UPDATE CASCADE,
   id_user_moderator INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   PRIMARY KEY (id_group, id_user_moderator)
);

CREATE TABLE group_member (
   id_group INTEGER NOT NULL REFERENCES groups(id) ON UPDATE CASCADE,
   id_user_member INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   PRIMARY KEY (id_group, id_user_member)
);

CREATE TABLE interest (
   id SERIAL PRIMARY KEY,
   name TEXT NOT NULL,
   description TEXT NOT NULL
);

/*
CREATE TABLE user_interest (
   id_interest INTEGER NOT NULL REFERENCES interest(id) ON UPDATE CASCADE,
   id_user INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   PRIMARY KEY (id_user, id_interest)
);
*/

CREATE TABLE notification (
   id SERIAL PRIMARY KEY,
   id_user INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   read BOOLEAN NOT NULL
);

CREATE TABLE like_notification (
   id_notification INTEGER PRIMARY KEY REFERENCES notification(id) ON UPDATE CASCADE,  --TODO: create trigger to delete parent notification when child is deleted
   id_like INTEGER NOT NULL REFERENCES content_like(id) ON UPDATE CASCADE ON DELETE CASCADE
   --FOREIGN KEY (id_user, id_content) REFERENCES content_like(id_user, id_content) ON UPDATE CASCADE  --see content_like explanation
);


CREATE TABLE reply_notification (
   id_notification INTEGER PRIMARY KEY REFERENCES notification(id) ON UPDATE CASCADE
);


CREATE TABLE friend_request_notification (
   id_notification INTEGER PRIMARY KEY REFERENCES notification(id) ON UPDATE CASCADE,
   id_friend_request INTEGER NOT NULL REFERENCES friend_request(id) ON UPDATE CASCADE
);

CREATE TABLE comment_notification (
   id_notification INTEGER PRIMARY KEY REFERENCES notification(id) ON UPDATE CASCADE,
   id_comment INTEGER NOT NULL REFERENCES comment(id) ON UPDATE CASCADE
);


CREATE TABLE text_content_reply_notification (
   id_reply_notification INTEGER PRIMARY KEY REFERENCES reply_notification(id_notification) ON UPDATE CASCADE,
   id_text_content INTEGER NOT NULL REFERENCES text_content(id_content) ON UPDATE CASCADE
);


CREATE TABLE payment_method (
   id SERIAL PRIMARY KEY,
   name TEXT NOT NULL,
   company TEXT NOT NULL,
   transaction_limit FLOAT NOT NULL,
   CONSTRAINT transaction_limit_ck CHECK (transaction_limit > 0.0)
);

/*
CREATE TABLE campaign (
   id_media_content INTEGER PRIMARY KEY REFERENCES media_content(id_content) ON UPDATE CASCADE,
   id_advertiser INTEGER NOT NULL REFERENCES advertiser(id_user) ON UPDATE CASCADE,
   starting_date TIMESTAMP WITH TIME ZONE NOT NULL,
   finishing_date TIMESTAMP WITH TIME ZONE NOT NULL,
   budget FLOAT NOT NULL,
   remaining_budget FLOAT NOT NULL,
   impressions INTEGER,
   clicks INTEGER,
   CONSTRAINT campaign_dates_ck CHECK (finishing_date > starting_date),
   CONSTRAINT campaign_budget_ck CHECK (remaining_budget <= budget)
);
*/

CREATE TABLE game_session (
   id SERIAL PRIMARY KEY,
   session_title TEXT NOT NULL
);

/*
CREATE TABLE game_stats (
   id_user INTEGER PRIMARY KEY REFERENCES users(id) ON UPDATE CASCADE,
   id_game_session INTEGER NOT NULL REFERENCES game_session(id) ON UPDATE CASCADE,
   score INTEGER NOT NULL
);
*/

CREATE TABLE friends (
   id_user1 INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   id_user2 INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   PRIMARY KEY (id_user1, id_user2),
   CONSTRAINT friend_diff_ck CHECK (id_user1 <> id_user2)
);

--------------------------------------------
--TRANSACTION
--------------------------------------------



--------------------------------------------
--INDEX
--------------------------------------------
--Performance Indexes

-- IDX01
CREATE INDEX user_content ON content USING hash (id_creator);

-- IDX02
CREATE INDEX mediacontent_location ON media_content USING btree (id_locale);
CLUSTER media_content USING mediacontent_location;

-- IDX03
/*CREATE INDEX end_campaign ON campaign USING btree (finishing_date);*/


--Full Text Search Indexes

-- IDX 11
-- Add column to text_content to store computed ts_vectors.
ALTER TABLE text_content
ADD COLUMN tsvectors TSVECTOR;

-- Create a function to automatically update ts_vectors.
CREATE FUNCTION text_content_search_update() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF TG_OP = 'INSERT' THEN
      NEW.tsvectors = (
         setweight(to_tsvector('english', NEW.post_text), 'A')
      );
   END IF;
   IF TG_OP = 'UPDATE' THEN
      IF (NEW.post_text <> OLD.post_text) THEN
         NEW.tsvectors = (
            setweight(to_tsvector('english', NEW.post_text), 'A')
         );
      END IF;
   END IF;
   RETURN NEW;
END
$$;

-- Create a trigger before insert or update on text_content.
CREATE TRIGGER text_content_search_update
   BEFORE INSERT OR UPDATE ON text_content
   FOR EACH ROW
   EXECUTE PROCEDURE text_content_search_update();

-- Finally, create a GIN index for ts_vectors.
CREATE INDEX text_content_search_idx ON text_content USING GIN (tsvectors);


-- IDX12
-- Add column to media_content to store computed ts_vectors.
ALTER TABLE media_content
ADD COLUMN tsvectors TSVECTOR;

-- Create a function to automatically update ts_vectors.
CREATE FUNCTION media_content_search_update() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF TG_OP = 'INSERT' THEN
      NEW.tsvectors = (
         setweight(to_tsvector('english', NEW.description), 'A') ||
         setweight(to_tsvector('english', NEW.alt_text), 'B')
      );
   END IF;
   IF TG_OP = 'UPDATE' THEN
      IF (NEW.description <> OLD.description OR NEW.alt_text <> OLD.alt_text) THEN
         NEW.tsvectors = (
            setweight(to_tsvector('english', NEW.description), 'A') ||
            setweight(to_tsvector('english', NEW.alt_text), 'B')
         );
      END IF;
   END IF;
   RETURN NEW;
END
$$;

-- Create a trigger before insert or update on media_content.
CREATE TRIGGER media_content_search_update
   BEFORE INSERT OR UPDATE ON media_content
   FOR EACH ROW
   EXECUTE PROCEDURE media_content_search_update();

-- Finally, create a GIN index for ts_vectors.
CREATE INDEX media_content_search_idx ON media_content USING GIN (tsvectors);


-- IDX 13
-- Add column to video to store computed ts_vectors.
ALTER TABLE video
ADD COLUMN tsvectors TSVECTOR;

-- Create a function to automatically update ts_vectors.
CREATE FUNCTION video_search_update() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF TG_OP = 'INSERT' THEN
      NEW.tsvectors = (
         setweight(to_tsvector('english', NEW.title), 'A')
      );
   END IF;
   IF TG_OP = 'UPDATE' THEN
      IF (NEW.title <> OLD.title) THEN
         NEW.tsvectors = (
            setweight(to_tsvector('english', NEW.title), 'A')
         );
      END IF;
   END IF;
   RETURN NEW;
END
$$;

-- Create a trigger before insert or update on video.
CREATE TRIGGER video_search_update
   BEFORE INSERT OR UPDATE ON video
   FOR EACH ROW
   EXECUTE PROCEDURE video_search_update();

-- Finally, create a GIN index for ts_vectors.
CREATE INDEX video_search_idx ON video USING GIN (tsvectors);


--------------------------------------------
--TRIGGERS
--------------------------------------------
--TRIGGER 1

CREATE FUNCTION comment_date() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF ((SELECT publishing_date FROM content WHERE id = NEW.id_media_content) > NEW.comment_date) THEN RAISE EXCEPTION 'content date greater than comment date';
   END IF;
   RETURN NEW;
END;
$$;

CREATE TRIGGER comment_date
   BEFORE INSERT OR UPDATE ON comment
   FOR EACH ROW
   EXECUTE PROCEDURE comment_date();


--TRIGGER 2

CREATE FUNCTION text_date() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF ((SELECT publishing_date FROM content WHERE id = NEW.child_text) <= (SELECT publishing_date FROM content WHERE id = NEW.parent_text)) THEN RAISE EXCEPTION 'Parent reply date greater than child date';
   END IF;
   RETURN NEW;
END;
$$;

CREATE TRIGGER text_date
   BEFORE INSERT OR UPDATE ON text_reply
   FOR EACH ROW
   EXECUTE PROCEDURE text_date();


--TRIGGER 3

CREATE FUNCTION friendship() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF EXISTS (SELECT * FROM friends WHERE id_user1 = NEW.id_user2 AND id_user2 = NEW.id_user1) THEN RAISE EXCEPTION 'This friend relationship is already defined.';
   END IF;
   RETURN NEW;
END;
$$;

CREATE TRIGGER friendship
   BEFORE INSERT OR UPDATE ON friends
   FOR EACH ROW
   EXECUTE PROCEDURE friendship();


--TRIGGER 4

CREATE FUNCTION text_content_disjoint() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF EXISTS (SELECT * FROM media_content WHERE id_content = NEW.id_content) THEN RAISE EXCEPTION 'Content is already a media content.';
   END IF;
   UPDATE content SET contentable_type = 'App\Models\TextContent' WHERE content.id = NEW.id_content;
   RETURN NEW;
END;
$$;

CREATE TRIGGER text_content_disjoint
   BEFORE INSERT OR UPDATE ON text_content
   FOR EACH ROW
   EXECUTE PROCEDURE text_content_disjoint();

--TRIGGER 5

CREATE FUNCTION media_content_disjoint() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF EXISTS (SELECT * FROM text_content WHERE id_content = NEW.id_content) THEN RAISE EXCEPTION 'Content is already a text content.';
   END IF;
   UPDATE content SET contentable_type = 'App\Models\MediaContent' WHERE content.id = NEW.id_content;
   RETURN NEW;
END;
$$;

CREATE TRIGGER media_content_disjoint
   BEFORE INSERT OR UPDATE ON media_content
   FOR EACH ROW
   EXECUTE PROCEDURE media_content_disjoint();



--TRIGGER 6

CREATE FUNCTION image_disjoint() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF EXISTS (SELECT * FROM video WHERE id_media_content = NEW.id_media_content) THEN RAISE EXCEPTION 'Media is already a video.';
   END IF;
   UPDATE media_content SET media_contentable_type = 'App\Models\Image' WHERE media_content.id_content = NEW.id_media_content;
   RETURN NEW;
END;
$$;

CREATE TRIGGER image_disjoint
   BEFORE INSERT OR UPDATE ON image
   FOR EACH ROW
   EXECUTE PROCEDURE image_disjoint();

--TRIGGER 7

CREATE FUNCTION video_disjoint() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF EXISTS (SELECT * FROM image WHERE id_media_content = NEW.id_media_content) THEN RAISE EXCEPTION 'Media is already a image.';
   END IF;
   UPDATE media_content SET media_contentable_type = 'App\Models\Video' WHERE media_content.id_content = NEW.id_media_content;
   RETURN NEW;
END;
$$;

CREATE TRIGGER video_disjoint
   BEFORE INSERT OR UPDATE ON video
   FOR EACH ROW
   EXECUTE PROCEDURE video_disjoint();


-- NOTIFICATIONS TRIGGERS

----- LIKE TRIGGER
CREATE FUNCTION like_notifications() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF NEW.id_user <> (SELECT id_creator FROM content WHERE id = NEW.id_content) THEN
   --create notification and like notification
      WITH new_notification AS (
         INSERT INTO notification (id_user, read)
         VALUES ((SELECT id_creator FROM content WHERE id = NEW.id_content), FALSE)
         RETURNING id
      )
      INSERT INTO like_notification (id_notification, id_like)
      VALUES ((SELECT id FROM new_notification), NEW.id);
   END IF;
   RETURN NEW;
END;
$$;

CREATE TRIGGER like_notifications
   AFTER INSERT ON content_like
   FOR EACH ROW
   EXECUTE PROCEDURE like_notifications();

-- deletes notification (superclass) when like notification is deleted (subclass)
CREATE FUNCTION delete_notification_after_dislike() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   DELETE FROM notification
   WHERE OLD.id_notification = id;
   RETURN NEW;
END;
$$;

CREATE TRIGGER delete_notification_after_dislike
   AFTER DELETE ON like_notification
   FOR EACH ROW
   EXECUTE PROCEDURE delete_notification_after_dislike();


----- FRIEND REQUEST TRIGGER
CREATE FUNCTION friend_requests_notifications() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   --create notification and friend request notification
   WITH new_notification AS (
      INSERT INTO notification (id_user, read)
      VALUES (NEW.id_receiver, FALSE)
      RETURNING id
   )
   INSERT INTO friend_request_notification (id_notification, id_friend_request)
   VALUES ((SELECT id FROM new_notification), NEW.id);
   RETURN NEW;
END;
$$;

CREATE TRIGGER friend_requests_notifications
   AFTER INSERT ON friend_request
   FOR EACH ROW
   EXECUTE PROCEDURE friend_requests_notifications();


----- COMMENT TRIGGER
CREATE FUNCTION comments_notifications() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF NEW.id_author <> (SELECT id_creator FROM content WHERE id IN (SELECT id_content FROM media_content WHERE id_content = NEW.id_media_content)) THEN
      --create notification and comment notification
      WITH new_notification AS (
         INSERT INTO notification (id_user, read)
         VALUES ((SELECT id_creator
               FROM content
               WHERE id IN (SELECT id_content
                              FROM media_content
                              WHERE id_content = NEW.id_media_content)), FALSE)
         RETURNING id
      )
      INSERT INTO comment_notification (id_notification, id_comment)
      VALUES ((SELECT id FROM new_notification), NEW.id);
   END IF;
   RETURN NEW;
END;
$$;

CREATE TRIGGER comments_notifications
   AFTER INSERT ON comment
   FOR EACH ROW
   EXECUTE PROCEDURE comments_notifications();

/*
----- TEXT REPLY TRIGGER
CREATE FUNCTION text_replies_notifications() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   --create text reply notification
   RETURN NEW;
END;
$$;

CREATE TRIGGER text_replies_notifications
   AFTER INSERT ON text_reply
   FOR EACH ROW
   EXECUTE PROCEDURE text_replies_notifications();

--------------------------------------------
*/

--Create anonymous user (shared user for deleted accounts)
INSERT INTO country (id, iso_3166, name) VALUES (1, '', '');
SELECT setval('country_id_seq', (SELECT max(id) FROM country));
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday, description) VALUES (1, 'anonymous', 'Anonymous User', 'support@socialup.com', '', 'img/profile_pic.png', NULL, NULL, 1, '1970-1-1', 'A random test user description');
SELECT setval('users_id_seq', (SELECT max(id) FROM users));

--Alpha-3 code
INSERT INTO country (id, iso_3166, name) VALUES (2, 'ALA', 'Åland Islands');
INSERT INTO country (id, iso_3166, name) VALUES (3, 'ALB', 'Albania');
INSERT INTO country (id, iso_3166, name) VALUES (4, 'DZA', 'Algeria');
INSERT INTO country (id, iso_3166, name) VALUES (5, 'ASM', 'American Samoa');
INSERT INTO country (id, iso_3166, name) VALUES (6, 'AND', 'Andorra');
INSERT INTO country (id, iso_3166, name) VALUES (7, 'AGO', 'Angola');
INSERT INTO country (id, iso_3166, name) VALUES (8, 'AIA', 'Anguilla');
INSERT INTO country (id, iso_3166, name) VALUES (9, 'ATA', 'Antarctica');
INSERT INTO country (id, iso_3166, name) VALUES (10, 'ATG', 'Antigua and Barbuda');
INSERT INTO country (id, iso_3166, name) VALUES (11, 'PRT', 'Portugal');
INSERT INTO country (id, iso_3166, name) VALUES (12, 'AFG', 'Afghanistan');
SELECT setval('country_id_seq', (SELECT max(id) FROM country));

INSERT INTO locale (id, region, id_country) VALUES (1, 'Badakhshan', 1);
INSERT INTO locale (id, region, id_country) VALUES (2, 'Jomala', 2);
INSERT INTO locale (id, region, id_country) VALUES (3, 'Kavaje', 3);
INSERT INTO locale (id, region, id_country) VALUES (4, 'Adrar', 4);
INSERT INTO locale (id, region, id_country) VALUES (5, 'Fagatogo', 5);
INSERT INTO locale (id, region, id_country) VALUES (6, 'Andorra-a-Velha', 6);
INSERT INTO locale (id, region, id_country) VALUES (7, 'Luanda', 7);
INSERT INTO locale (id, region, id_country) VALUES (8, 'Vale', 8);
INSERT INTO locale (id, region, id_country) VALUES (9, 'Antarctica', 9);
INSERT INTO locale (id, region, id_country) VALUES (10, 'Saint John', 10);
INSERT INTO locale (id, region, id_country) VALUES (11, 'Porto', 11);
SELECT setval('locale_id_seq', (SELECT max(id) FROM locale));

INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (2, 'Prabovers', 'David N. Thomas', 'user@example.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '561-883-6567', 12, '1988-2-13'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (3, 'Rivinquister', 'Robert A. West', 'RobertAWest@armyspy.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '616-261-7167', 2, '1962-10-20'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (4, 'Hoppled91', 'Isaac K. Spencer', 'IsaacKSpencer@dayrep.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '914-964-9238', 2, '1991-8-6'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (5, 'Ingled91', 'Tim K. Gutierrez', 'TimKGutierrez@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '270-379-5170', 3, '1991-10-28'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (6, 'Daimpas1985', 'William T. Hancock', 'WilliamTHancock@jourrapide.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '504-491-4903', 3, '1985-7-13'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (7, 'Forneved', 'Paul J. Gillen', 'PaulJGillen@jourrapide.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '203-509-4665', 4, '1947-10-27'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (8, 'Stoonce', 'Clarence S. Catron', 'ClarenceSCatron@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '406-775-1564', 4, '1995-4-20'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (9, 'Walcon', 'Susanne M. Miller', 'SusanneMMiller@dayrep.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '631-444-4388', 5, '1986-11-29'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (10, 'Museltole', 'John K. Shuman', 'JohnKShuman@jourrapide.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '919-484-3756', 5, '1983-9-22'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (11, 'Hatecrable2000', 'Jeniffer J. Parsons', 'JenifferJParsons@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '814-845-9721', 6, '2000-3-1'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (12, 'Dights1956', 'Kim B. McClain', 'KimBMcClain@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '702-243-7350', 6, '1956-12-17'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (13, 'Examated', 'Casey J. Russo', 'CaseyJRusso@jourrapide.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '314-765-9362', 7, '1996-8-24'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (14, 'Thenly', 'Ines C. Yancey', 'InesCYancey@jourrapide.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '203-736-5651', 7, '1992-4-27'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (15, 'Caus1973', 'Patricia E. Horton', 'PatriciaEHorton@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '336-750-8290', 8, '1973-7-23'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (16, 'Lighbothe', 'Cathy F. McBride', 'CathyFMcBride@jourrapide.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '801-667-2817', 8, '1958-8-15'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (17, 'Hatumer', 'Betty R. Seamon', 'BettyRSeamon@rhyta.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '302-570-5766', 9, '1985-11-8'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (18, 'Buls1950', 'Silvia P. Broadhurst', 'SilviaPBroadhurst@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '781-727-1458', 9, '1950-2-21'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (19, 'Ourne2001', 'Scott K. Goode', 'ScottKGoode@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '352-431-8723', 10, '2001-4-13'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (20, 'Miltary58', 'Carmela H. Choi', 'CarmelaHChoi@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '360-697-3591', 11, '1958-6-2'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (21, 'Evernshould', 'Evelyn M. Dudley', 'EvelynMDudley@rhyta.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'img/profile_pic.png', NULL, '561-265-2290', 12, '1956-3-4'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (22, 'admin', 'SU Admin', 'admin@socialup.com', '$2y$10$EOAidWrMdRctCQLsICSVXuLvTEquByvzlAMbd31Vm7io4r3O5xJy6', 'img/profile_pic.png', NULL, '931234567', 11, '1990-5-7'); --admin
SELECT setval('users_id_seq', (SELECT max(id) FROM users));

INSERT INTO admin_user (id_user) VALUES (21);
INSERT INTO admin_user (id_user) VALUES (22);

INSERT INTO wallet (id, budget) VALUES (1, 100);
INSERT INTO wallet (id, budget) VALUES (2, 1000);
INSERT INTO wallet (id, budget) VALUES (3, 10000);
INSERT INTO wallet (id, budget) VALUES (4, 100000);
INSERT INTO wallet (id, budget) VALUES (5, 500);
INSERT INTO wallet (id, budget) VALUES (6, 5000);
INSERT INTO wallet (id, budget) VALUES (7, 50000);
INSERT INTO wallet (id, budget) VALUES (8, 200);
INSERT INTO wallet (id, budget) VALUES (9, 2000);
INSERT INTO wallet (id, budget) VALUES (10, 20000);
SELECT setval('wallet_id_seq', (SELECT max(id) FROM wallet));

/*
INSERT INTO advertiser (id_user, company_name, id_wallet) VALUES (1, 'caes', 1);
INSERT INTO advertiser (id_user, company_name, id_wallet) VALUES (2, 'lightals', 2);
INSERT INTO advertiser (id_user, company_name, id_wallet) VALUES (3, 'videothings', 3);
INSERT INTO advertiser (id_user, company_name, id_wallet) VALUES (4, 'shoras', 4);
INSERT INTO advertiser (id_user, company_name, id_wallet) VALUES (5, 'ProductLoft', 5);
INSERT INTO advertiser (id_user, company_name, id_wallet) VALUES (6, 'buyables', 6);
INSERT INTO advertiser (id_user, company_name, id_wallet) VALUES (7, 'doores', 7);
INSERT INTO advertiser (id_user, company_name, id_wallet) VALUES (8, 'weons', 8);
INSERT INTO advertiser (id_user, company_name, id_wallet) VALUES (9, 'surfarts', 9);
INSERT INTO advertiser (id_user, company_name, id_wallet) VALUES (10, 'Diads', 10);
*/

INSERT INTO groups (id, name, description) VALUES (1, 'Game Development', 'Who doens t like games? Join Us');
INSERT INTO groups (id, name, description) VALUES (2, 'Motards', 'We love bikes more than ourselves!');
INSERT INTO groups (id, name, description) VALUES (3, 'Basketball', 'Kobe!!!!!');
SELECT setval('groups_id_seq', (SELECT max(id) FROM groups));

INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (1, '2021-5-23', NULL, 1);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (2, '2015-7-28', 2, 2);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (3, '2021-10-3 15:03:25', NULL, 3);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (4, '2021-10-12', 1, 4);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (5, '2019-1-10', NULL, 5);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (6, '2018-9-20', NULL, 6);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (7, '2021-5-7', NULL, 7);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (8, '2020-2-16', 1, 8);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (9, '2021-6-29', NULL, 9);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (10, '2020-1-3', NULL, 10);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (11, '2021-10-3 15:32:13', NULL, 4);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (12, '2021-10-3 15:51:37', NULL, 7);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (13, '2021-10-3 16:08:54', NULL, 4);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (14, '2021-10-3 16:14:34', NULL, 9);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (15, '2021-10-3 16:34:28', NULL, 10);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (16, '2021-10-3 16:37:09', NULL, 8);
SELECT setval('content_id_seq', (SELECT max(id) FROM content));

INSERT INTO content_like (id, date, id_user, id_content) VALUES (1, '2021-5-23', 1, 1);
INSERT INTO content_like (id, date, id_user, id_content) VALUES (2, '2015-7-28', 2, 2);
INSERT INTO content_like (id, date, id_user, id_content) VALUES (3, '2020-4-3', 3, 3);
INSERT INTO content_like (id, date, id_user, id_content) VALUES (4, '2021-10-12', 4, 4);
INSERT INTO content_like (id, date, id_user, id_content) VALUES (5, '2019-1-10', 5, 5);
INSERT INTO content_like (id, date, id_user, id_content) VALUES (6, '2018-9-20', 6, 6);
INSERT INTO content_like (id, date, id_user, id_content) VALUES (7, '2021-5-7', 7, 7);
INSERT INTO content_like (id, date, id_user, id_content) VALUES (8, '2020-2-16', 8, 8);
INSERT INTO content_like (id, date, id_user, id_content) VALUES (9, '2021-6-29', 9, 9);
INSERT INTO content_like (id, date, id_user, id_content) VALUES (10, '2020-1-3', 10, 10);
SELECT setval('content_like_id_seq', (SELECT max(id) FROM content_like));

INSERT INTO text_content (id_content, post_text) VALUES (1, 'Today i made a funny thing!');
INSERT INTO text_content (id_content, post_text) VALUES (2, 'I love to write SQL');
INSERT INTO text_content (id_content, post_text) VALUES (3, 'LBAW is the best course in the world');
INSERT INTO text_content (id_content, post_text) VALUES (4, 'Who is the best football player?');
INSERT INTO text_content (id_content, post_text) VALUES (5, 'Take it easy, keep calm');
INSERT INTO text_content (id_content, post_text) VALUES (11, 'I agree, it''s pretty interesting! ╰(*°▽°*)╯');
INSERT INTO text_content (id_content, post_text) VALUES (12, 'I''ll have to disagree, because all of the courses are great 🤩');
INSERT INTO text_content (id_content, post_text) VALUES (13, 'ahah you had us in the first part ngl.');
INSERT INTO text_content (id_content, post_text) VALUES (14, 'Yes, but we are expected to work too much, considering the time we have and the other courses that also expect a lot of work from us');
INSERT INTO text_content (id_content, post_text) VALUES (15, 'Laravel is cool');
INSERT INTO text_content (id_content, post_text) VALUES (16, 'Agreed 😕');

INSERT INTO text_reply (child_text, parent_text) VALUES (1, 2);
INSERT INTO text_reply (child_text, parent_text) VALUES (11, 3);
INSERT INTO text_reply (child_text, parent_text) VALUES (12, 11);
INSERT INTO text_reply (child_text, parent_text) VALUES (13, 12);
INSERT INTO text_reply (child_text, parent_text) VALUES (14, 3);
INSERT INTO text_reply (child_text, parent_text) VALUES (15, 11);
INSERT INTO text_reply (child_text, parent_text) VALUES (16, 14);

INSERT INTO media_content (id_content, description, media, alt_text, fullscreen, id_locale) VALUES (6, 'Just a cute cat', 'media/cute.png', 'Photo of a cat playing', TRUE, 6);
INSERT INTO media_content (id_content, description, media, alt_text, fullscreen, id_locale) VALUES (7, 'BMW', 'media/moto.jpeg', NULL, FALSE, 7);
INSERT INTO media_content (id_content, description, media, alt_text, fullscreen, id_locale) VALUES (8, 'Mercedes car', 'media/car.png', 'Picture of a Mercedes car', TRUE, 8);
INSERT INTO media_content (id_content, description, media, alt_text, fullscreen, id_locale) VALUES (9, 'Learn SQL for beginners', 'media/tutorial.mp4', 'Video tutorial', FALSE, 9);
INSERT INTO media_content (id_content, description, media, alt_text, fullscreen, id_locale) VALUES (10, 'Gameplay of Fortnite. ;)', 'media/game.mp4', NULL, FALSE, 10);

INSERT INTO image (id_media_content, width, height) VALUES (6, 200, 100);
INSERT INTO image (id_media_content, width, height) VALUES (7, 300, 400);
INSERT INTO image (id_media_content, width, height) VALUES (8, 500, 100);

INSERT INTO video (id_media_content, title, views) VALUES (9, 'SQL Tutorial 2021', 100);
INSERT INTO video (id_media_content, title, views) VALUES (10, 'Game', 300);

INSERT INTO comment (id, comment_text, comment_date, id_author, id_media_content) VALUES (1, 'So cute!', '2021-10-11', 1, 6);
INSERT INTO comment (id, comment_text, comment_date, id_author, id_media_content) VALUES (2, 'Very good brand', '2021-10-12', 2, 7);
INSERT INTO comment (id, comment_text, comment_date, id_author, id_media_content) VALUES (3, 'I do not like that car', '2021-10-13', 3, 8);
INSERT INTO comment (id, comment_text, comment_date, id_author, id_media_content) VALUES (4, 'Great tutorial', '2021-10-14', 4, 9);
INSERT INTO comment (id, comment_text, comment_date, id_author, id_media_content) VALUES (5, 'I play this game all the time', '2021-10-15', 5, 10);
INSERT INTO comment (id, comment_text, comment_date, id_author, id_media_content) VALUES (6, 'Best Dev Interview I have seen!', '2020-05-22', 5, 10);
SELECT setval('comment_id_seq', (SELECT max(id) FROM comment));

INSERT INTO friend_request (id, creation_date, id_sender, id_receiver) VALUES (1, '2020-7-23', 1, 2);
INSERT INTO friend_request (id, creation_date, id_sender, id_receiver) VALUES (2, '2021-3-2', 1, 3);
INSERT INTO friend_request (id, creation_date, id_sender, id_receiver) VALUES (3, '2021-10-11', 3, 6);
INSERT INTO friend_request (id, creation_date, id_sender, id_receiver) VALUES (4, '2020-9-8', 4, 5);
INSERT INTO friend_request (id, creation_date, id_sender, id_receiver) VALUES (5, '2021-6-11', 6, 7);
INSERT INTO friend_request (id, creation_date, id_sender, id_receiver) VALUES (6, '2021-12-31', 10, 11);
SELECT setval('friend_request_id_seq', (SELECT max(id) FROM friend_request));

INSERT INTO accepted_friend_request (id_friend_request, accepted_date) VALUES (1, '2021-7-24');
INSERT INTO accepted_friend_request (id_friend_request, accepted_date) VALUES (2, '2021-7-23');
INSERT INTO accepted_friend_request (id_friend_request, accepted_date) VALUES (3, '2021-11-23');

INSERT INTO rejected_friend_request (id_friend_request, rejected_date) VALUES (4, '2021-10-23');
INSERT INTO rejected_friend_request (id_friend_request, rejected_date) VALUES (5, '2021-7-23');

/*
INSERT INTO message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (1, 'Hello', 1, 2, '2021-10-15');
INSERT INTO message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (2, 'Hi', 2, 3, '2021-10-23');
INSERT INTO message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (3, 'Can I ask you something?', 3, 4, '2021-10-27');
INSERT INTO message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (4, 'Hey there!', 4, 5, '2021-10-3');
INSERT INTO message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (5, 'I would like to meet you!', 5, 6, '2021-10-1');
SELECT setval('message_id_seq', (SELECT max(id) FROM message));
*/

INSERT INTO group_moderator (id_group, id_user_moderator) VALUES (1, 1);

INSERT INTO group_member (id_group, id_user_member) VALUES (1, 1);
INSERT INTO group_member (id_group, id_user_member) VALUES (1, 3);
INSERT INTO group_member (id_group, id_user_member) VALUES (2, 4);
INSERT INTO group_member (id_group, id_user_member) VALUES (2, 5);
INSERT INTO group_member (id_group, id_user_member) VALUES (2, 6);


INSERT INTO interest (id, name, description) VALUES (1, 'Software', 'Instructions that tell a computer what to do');
INSERT INTO interest (id, name, description) VALUES (2, 'Hardware', 'The machines themselves as opposed to the programs which tell the machines what to do');
INSERT INTO interest (id, name, description) VALUES (3, 'Cars', 'A road vehicle with an engine');
INSERT INTO interest (id, name, description) VALUES (4, 'History', 'The study of past events, particularly in human affairs.');
INSERT INTO interest (id, name, description) VALUES (5, 'Boats', 'Small vesseles for travelling over water');
SELECT setval('interest_id_seq', (SELECT max(id) FROM interest));

/*
INSERT INTO user_interest (id_interest, id_user) VALUES (1, 1);
INSERT INTO user_interest (id_interest, id_user) VALUES (2, 2);
INSERT INTO user_interest (id_interest, id_user) VALUES (3, 3);
*/

/*
INSERT INTO notification (id, id_user, read) VALUES (1, 1, FALSE);
INSERT INTO notification (id, id_user, read) VALUES (2, 2, FALSE);
INSERT INTO notification (id, id_user, read) VALUES (3, 3, FALSE);
INSERT INTO notification (id, id_user, read) VALUES (4, 4, FALSE);
INSERT INTO notification (id, id_user, read) VALUES (5, 5, FALSE);
SELECT setval('notification_id_seq', (SELECT max(id) FROM notification));

INSERT INTO like_notification (id_notification, id_like) VALUES (1, 1);
INSERT INTO like_notification (id_notification, id_like) VALUES (2, 2);

INSERT INTO reply_notification (id_notification) VALUES (1);
INSERT INTO reply_notification (id_notification) VALUES (2);

INSERT INTO friend_request_notification (id_notification, id_friend_request) VALUES (3, 3);
INSERT INTO friend_request_notification (id_notification, id_friend_request) VALUES (4, 4);

INSERT INTO comment_notification (id_reply_notification, id_comment) VALUES (1, 1);

INSERT INTO text_content_reply_notification (id_reply_notification, id_text_content) VALUES (1, 2);
*/
INSERT INTO payment_method (id, name, company, transaction_limit) VALUES (1, 'PayPal', 'PayPal', 10000);
SELECT setval('payment_method_id_seq', (SELECT max(id) FROM payment_method));

/*
INSERT INTO campaign (id_media_content, id_advertiser, starting_date, finishing_date, budget, remaining_budget, impressions, clicks) VALUES (9, 6, '2021-8-23', '2021-10-23', 1200, 700, 10, 5);
INSERT INTO campaign (id_media_content, id_advertiser, starting_date, finishing_date, budget, remaining_budget, impressions, clicks) VALUES (10, 7, '2021-4-23', '2021-7-23', 450, 200, 20, 100);

INSERT INTO game_session (id, session_title) VALUES (1, 'Funny Game');
INSERT INTO game_session (id, session_title) VALUES (2, 'Champions');
SELECT setval('game_session_id_seq', (SELECT max(id) FROM game_session));

INSERT INTO game_stats (id_user, id_game_session, score) VALUES (1, 1, 0);
INSERT INTO game_stats (id_user, id_game_session, score) VALUES (2, 1, 10);
INSERT INTO game_stats (id_user, id_game_session, score) VALUES (3, 1, 3);
INSERT INTO game_stats (id_user, id_game_session, score) VALUES (4, 2, 5);
INSERT INTO game_stats (id_user, id_game_session, score) VALUES (5, 2, 8);
INSERT INTO game_stats (id_user, id_game_session, score) VALUES (6, 2, 7);
*/

INSERT INTO friends (id_user1, id_user2) VALUES (2, 1);
INSERT INTO friends (id_user1, id_user2) VALUES (3, 1);
INSERT INTO friends (id_user1, id_user2) VALUES (4, 2);
