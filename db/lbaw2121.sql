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
DROP TABLE IF EXISTS message CASCADE;
DROP TABLE IF EXISTS groups CASCADE;
DROP TABLE IF EXISTS group_moderator CASCADE;
DROP TABLE IF EXISTS group_member CASCADE;
DROP TABLE IF EXISTS interest CASCADE;
DROP TABLE IF EXISTS user_interest CASCADE;
DROP TABLE IF EXISTS locale CASCADE;
DROP TABLE IF EXISTS country CASCADE;
DROP TABLE IF EXISTS payment_method CASCADE;
DROP TABLE IF EXISTS campaign CASCADE;
DROP TABLE IF EXISTS notification CASCADE;
DROP TABLE IF EXISTS like_notification CASCADE;
DROP TABLE IF EXISTS reply_notification CASCADE;
DROP TABLE IF EXISTS friend_request_notification CASCADE;
DROP TABLE IF EXISTS comment_reply_notification CASCADE;
DROP TABLE IF EXISTS text_content_reply_notification CASCADE;
DROP TABLE IF EXISTS game_session CASCADE;
DROP TABLE IF EXISTS game_stats CASCADE;
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

CREATE TABLE advertiser (
   id_user INTEGER PRIMARY KEY REFERENCES users(id) ON UPDATE CASCADE,
   company_name TEXT NOT NULL,
   id_wallet INTEGER NOT NULL REFERENCES wallet(id) NOT NULL
);

CREATE TABLE groups (
   id SERIAL PRIMARY KEY,
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
   author INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   id_media_content INTEGER NOT NULL REFERENCES media_content(id_content) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE friend_request (
   id SERIAL PRIMARY KEY,
   creation_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
   id_sender INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   id_receiver INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE
);

CREATE TABLE accepted_friend_request (
   id_friend_request INTEGER PRIMARY KEY REFERENCES friend_request(id) ON UPDATE CASCADE,
   accepted_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL
);

CREATE TABLE rejected_friend_request (
   id_friend_request INTEGER PRIMARY KEY REFERENCES friend_request(id) ON UPDATE CASCADE,
   rejected_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL
);

CREATE TABLE message (
   id SERIAL PRIMARY KEY,
   text TEXT NOT NULL,
   id_user_sender INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   id_user_receiver INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   msg_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL
);

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

CREATE TABLE user_interest (
   id_interest INTEGER NOT NULL REFERENCES interest(id) ON UPDATE CASCADE,
   id_user INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   PRIMARY KEY (id_user, id_interest)
);

CREATE TABLE notification (
   id SERIAL PRIMARY KEY,
   id_user INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   read BOOLEAN NOT NULL
);

CREATE TABLE like_notification (
   id_notification INTEGER PRIMARY KEY REFERENCES notification(id) ON UPDATE CASCADE,
   id_user INTEGER NOT NULL,
   id_content INTEGER NOT NULL,
   FOREIGN KEY (id_user, id_content) REFERENCES content_like(id_user, id_content) ON UPDATE CASCADE
);

CREATE TABLE reply_notification (
   id_notification INTEGER PRIMARY KEY REFERENCES notification(id) ON UPDATE CASCADE
);

CREATE TABLE friend_request_notification (
   id_notification INTEGER PRIMARY KEY REFERENCES notification(id) ON UPDATE CASCADE,
   id_friend_request INTEGER NOT NULL REFERENCES friend_request(id) ON UPDATE CASCADE
);

CREATE TABLE comment_reply_notification (
   id_reply_notification INTEGER PRIMARY KEY REFERENCES reply_notification(id_notification) ON UPDATE CASCADE,
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

CREATE TABLE game_session (
   id SERIAL PRIMARY KEY,
   session_title TEXT NOT NULL
);

CREATE TABLE game_stats (
   id_user INTEGER PRIMARY KEY REFERENCES users(id) ON UPDATE CASCADE,
   id_game_session INTEGER NOT NULL REFERENCES game_session(id) ON UPDATE CASCADE,
   score INTEGER NOT NULL
);

CREATE TABLE friends (
   id_user1 INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   id_user2 INTEGER NOT NULL REFERENCES users(id) ON UPDATE CASCADE,
   PRIMARY KEY (id_user1, id_user2),
   CONSTRAINT friend_diff_ck CHECK (id_user1 <> id_user2)
);

--------------------------------------------
--INDEX
--------------------------------------------
--Performance Indexes

-- IDX 1
CREATE INDEX user_content ON content USING hash (id_creator);

-- IDX 2
CREATE INDEX mediacontent_location ON media_content USING btree (id_locale);
CLUSTER media_content USING mediacontent_location;

-- IDX 3
CREATE INDEX end_campaign ON campaign USING btree (finishing_date);


--Full Text Search Indexes

-- IDX 4
-- Add column to content to store computed ts_vectors.
ALTER TABLE content
ADD COLUMN tsvectors TSVECTOR;

-- Create a function to automatically update ts_vectors.
CREATE FUNCTION content_search_update() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   -- Text Content ts_vectors updater
   IF (EXISTS (SELECT id_content FROM text_content WHERE id_content = NEW.id)) THEN
      NEW.tsvectors = (
         setweight(to_tsvector('english', coalesce((SELECT post_text FROM text_content WHERE id_content = NEW.id), '')), 'A')
      );
   END IF;

   -- Media Content ts_vectors updater
   IF (EXISTS (SELECT id_content FROM media_content WHERE id_content = NEW.id)) THEN

      -- Video content ts_vectors updater
      IF (EXISTS (SELECT id_media_content FROM video WHERE id_media_content = NEW.id)) THEN
         NEW.tsvectors = (
            setweight(to_tsvector('english', coalesce((SELECT title FROM video WHERE id_media_content = NEW.id), '')), 'A') ||
            setweight(to_tsvector('english', coalesce((SELECT description FROM media_content WHERE id_content = NEW.id), '')), 'B') ||
            setweight(to_tsvector('english', coalesce((SELECT alt_text FROM media_content WHERE id_content = NEW.id), '')), 'C')
         );
      -- Image content ts_vectors updater
      ELSE
         NEW.tsvectors = (
            setweight(to_tsvector('english', coalesce((SELECT description FROM media_content WHERE id_content = NEW.id), '')), 'A') ||
            setweight(to_tsvector('english', coalesce((SELECT alt_text FROM media_content WHERE id_content = NEW.id), '')), 'B')
         );
      END IF;
   END IF;

   RETURN NEW;
END
$$;

-- Create a trigger before insert or update on content.
CREATE TRIGGER content_search_update
   BEFORE UPDATE ON content
   FOR EACH ROW
   EXECUTE PROCEDURE content_search_update();

-- Finally, create a GIN index for ts_vectors.
CREATE INDEX content_search_idx ON content USING GIN (tsvectors);

-- IDX 5

-- Create a function to automatically update ts_vectors.
CREATE FUNCTION text_content_search_update() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   UPDATE content
   SET tsvectors = ''
   WHERE id = NEW.id_content;
   RETURN NEW;
END
$$;

-- Create a trigger before insert or update on text_content.
CREATE TRIGGER text_content_search_update
   BEFORE INSERT OR UPDATE ON text_content
   FOR EACH ROW
   EXECUTE PROCEDURE text_content_search_update();


-- IDX 6

-- Create a function to automatically update ts_vectors.
CREATE FUNCTION media_content_search_update() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   UPDATE content
   SET tsvectors = ''
   WHERE id = NEW.id_content;
   RETURN NEW;
END
$$;

-- Create a trigger before insert or update on media_content.
CREATE TRIGGER media_content_search_update
   BEFORE INSERT OR UPDATE ON media_content
   FOR EACH ROW
   EXECUTE PROCEDURE media_content_search_update();


-- IDX 7

-- Create a function to automatically update ts_vectors.
CREATE FUNCTION video_search_update() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   UPDATE content
   SET tsvectors = ''
   WHERE id = NEW.id_media_content;
   RETURN NEW;
END
$$;

-- Create a trigger before insert or update on video.
CREATE TRIGGER video_search_update
   BEFORE INSERT OR UPDATE ON video
   FOR EACH ROW
   EXECUTE PROCEDURE video_search_update();


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
   EXECUTE PROCEDURE image_disjoint()

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
   EXECUTE PROCEDURE video_disjoint()



--------------------------------------------

--Create anonymous user (shared user for deleted accounts)
INSERT INTO country (id, iso_3166, name) VALUES (1, '', '');
SELECT setval('country_id_seq', (SELECT max(id) FROM country));
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (1, 'anonymous', 'Anonymous User', 'support@socialup.com', '', NULL, NULL, NULL, 1, '1970-1-1');
SELECT setval('users_id_seq', (SELECT max(id) FROM users));
