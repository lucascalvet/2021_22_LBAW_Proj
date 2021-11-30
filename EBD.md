# EBD: Database Specification Component

> The next generation social network, powering UP people's connections. Step it UP with Social UP.

## A4: Conceptual Data Model

This artefact contains an overall view of the structure of the data, better visualized in the UML class diagram. We identify the classes in which the data will be stores and the relationships between said classes.

### 1. Class diagram



### 2. Additional Business Rules
 
- BR01: The media path for a MediaContent of type Image must correspond to an image file, and the one for a MediaContent of type Video must correspond to a video file.
- BR02: The date of a comment or a text reply must be later than the date of its parent content.

---


## A5: Relational Schema, validation and schema refinement

This artefact consists of the relational schema, which is a blueprint used in database design to represent the data to be entered into the database and describe how that data is structured in tables. Furthermore, we identify the functional dependencies of each relation with the goal of prefecting the schema as a whole.

### 1. Relational Schema

| Relation reference | Relation Compact Notation                        |
| ------------------ | ------------------------------------------------ |
| R01                | Users(__id__, username __UK__ __NN__, name __NN__, email __UK__ __NN__, hashed_password __NN__, profile_picture, cover_picture, phone_number, id_country → Country __NN__, birthday __NN__)                     |
| R02                | AdminUser(__id__)  |
| R03                | Advertiser(__id__, company_name __NN__, id_wallet → Wallet __NN__)  |
| R04                | Wallet(__id__, budget __NN__ __CK__ budget >= 0.0) |
| R05                | Content(__id__, publishing_date __NN__, id_group → Group __NN__, id_creator → Users __NN__)            |
| R06                | ContentLikes(__id_user__ → Users __NN__, __id_content__ → Content __NN__, date) |
| R07                | TextContent(__id__, post_text __NN__, id_content → Content __NN__)    |
| R08                | TextReply(__child_text__, parent_text __NN__)    |
| R09                | MediaContent(__id__, description __NN__, media __NN__, fullscreen, id_content → Content __NN__, id_locale)            |
| R10                | Video(__id__, title __NN__, size __CK__ size > 0.0, quality, views, id_media_content → MediaContent __NN__)            |
| R11                | Image(__id__, alt_text __NN__, width __CK__ width > 0, height __CK__ height > 0, id_media_content → MediaContent __NN__)  |
| R12                | Comment(__id__, comment_text __NN__, comment_date, author → Users __NN__, id_media_content → MediaContent __NN__) |
| R13                | FriendRequest(__id_user_from__ → Users __NN__, __id_user_to__ → Users __NN__, creation __NN__, state)                     |
| R14                | Message(__id__, text __NN__, id_user_sender → Users __NN__, id_user_receiver → Users __NN__, msg_date __NN__)   |
| R15                | Group(__id__, name __NN__, description)   |
| R16                | UserGroupModerator(__id_group__ → Group __NN__, __id_user_moderator__ → Users __NN__)   |
| R17                | UserGroupMember(__id_group__ → Group __NN__, __id_user_member__ → Users __NN__)   |
| R18                | Interest(__id__, name __NN__, description __NN__)                     |
| R19                | InterestUser(__id_interest__ → Interest __NN__, __id_user__ → Users __NN__)                     |
| R20                | Locale(__id__, region __NN__, id_country → Country __NN__)            |
| R21                | Country(__id__, iso_3166 __UK__, name __NN__)   |
| R22                | Notification(__id__, id_user → Users __NN__, read __NN__) |
| R23                | LikeNotification(__id_notification__ → Notification, id_like __NN__) |
| R24                | ReplyNotification(__id_notification__ → Notification) |
| R25                | FriendRequestNotification(__id_notification__ → Notification, id_friend_request → FriendRequest __NN__)  |
| R26                | CommentReplyNotification(__id_notification__ → Notification, id_comment → Comment __NN__) |
| R27                | TextContentReplyNotification(__id_notification__ → Notification, id_text_content → TextContent __NN__) |
| R28                | PaymentMethod(__id__, name __NN__, company __NN__, transaction_limit __NN__ __CK__ transaction_limit > 0.0) |
| R29                | Campaign(__id_media_content__ → MediaContent, id_advertiser → Advertiser __NN__, starting_date __NN__, finishing_date __NN__ __CK__ finishing_date > starting_date, budget __NN__, remaining_budget __NN__ __CK__ remaining_budget <= budget, impressions, clicks)   |
| R30                | GameSession(__id__, session_title __NN__)    |
| R31                | GameStats(__id_user__ → Users, id_game_session → GameSession __NN__, score __NN__)  |
| R32                | AcceptedFriendRequest(__id_friend_request__ → FriendRequest, accepted_date) |
| R33                | RejectedFriendRequest(__id_friend_request__ → FriendRequest, rejected_date) |
| R34                | Friends(__id_user1__ → Users, __id_user2__ → Users, __CK__ id_user1 > id_user2) | 

### 2. Domains


| Domain Name | Domain Specification           |
| ----------- | ------------------------------ |
| Today	      | DATE DEFAULT CURRENT_DATE      |
|             |                                |

### 3. Schema validation

| **TABLE R01**   | User                                            |
| --------------  | ---                                             |
| **Keys**        | { id }, { email }, { username }                 |
| **Functional Dependencies:** |                                    |
| FD0101          | id → {email, username, name, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday}                  |
| FD0102          | email → {id, usernamename, name, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday}                  |
| FD0103          | username → {id, email, name, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday}                  |
| **Normal Form** | BCNF                                            |

<br></br>

| **TABLE R02**   | AdminUser               |
| --------------  | ---                     |
| **Keys**        | { id }                  |
| **Functional Dependencies:** |  none      |
| **Normal Form** | BCNF                    |

<br></br>

| **TABLE R03**   | Advertiser                      |
| --------------  | ---                             |
| **Keys**        | { id }                          |
| **Functional Dependencies:** |                    |
| FD0301          | id → {company_name, id_wallet}  |
| **Normal Form** | BCNF                            |

<br></br>

| **TABLE R04**   | Wallet                          |
| --------------  | ---                             |
| **Keys**        | { id }                          |
| **Functional Dependencies:** |                    |
| FD0401          | id → {budget}                   |
| **Normal Form** | BCNF                            |

<br></br>

| **TABLE R05**   | Content                                         |
| --------------  | ---                                             |
| **Keys**        | { id }                                          |
| **Functional Dependencies:** |                                    |
| FD0501          | id → {publishing_date, id_group, id_creator}    |
| **Normal Form** | BCNF                                            |

<br></br>

| **TABLE R06**   | ContentLikes                            |
| --------------  | ---                                     |
| **Keys**        | { id_user, id_content }                 |
| **Functional Dependencies:** |                            |
| FD0601          | { id_user, id_content } → {date}        |
| **Normal Form** | BCNF                                    |

<br></br>

| **TABLE R07**   | TextContent                             |
| --------------  | ---                                     |
| **Keys**        | { id }                                  |
| **Functional Dependencies:** |                            |
| FD0701          | id → {post_text, id_content}            |
| **Normal Form** | BCNF                                    |

<br></br>

| **TABLE R08**   | TextReply                   |
| --------------  | ---                         |
| **Keys**        | { child_text }              |
| **Functional Dependencies:** |                |
| FD0801          | child_text → {parent_text}  |
| **Normal Form** | BCNF                        |

<br></br>

| **TABLE R09**   | MediaContent        |
| --------------  | ---                 |
| **Keys**        | { id }              |
| **Functional Dependencies:** |        |
| FD0901          | id → {description, media, fullscreen, id_content, id_locale} |
| **Normal Form** | BCNF                |

<br></br>

| **TABLE R10**   | Video               |
| --------------  | ---                 |
| **Keys**        | { id }              |
| **Functional Dependencies:** |        |
| FD1001          | id → {title, size, quality, views, id_media_content} |
| **Normal Form** | BCNF                |

<br></br>

| **TABLE R11**   | Image               |
| --------------  | ---                 |
| **Keys**        | { id }              |
| **Functional Dependencies:** |        |
| FD1101          | id → {alt_text, width, height, id_media_content} |
| **Normal Form** | BCNF                |

<br></br>

| **TABLE R12**   | Comment             |
| --------------  | ---                 |
| **Keys**        | { id }              |
| **Functional Dependencies:** |        |
| FD1201          | id → {comment_text, comment_date, author, id_media_content} |
| **Normal Form** | BCNF                |

<br></br>

| **TABLE R13**   | FriendRequest                   |
| --------------  | ---                             |
| **Keys**        | { id_user_from, id_user_to }    |
| **Functional Dependencies:** |                    |
| FD1301          | { id_user_from, id_user_to } → {creation, state} |
| **Normal Form** | BCNF                            |

<br></br>

| **TABLE R14**   | Message                         |
| --------------  | ---                             |
| **Keys**        | { id }                          |
| **Functional Dependencies:** |                    |
| FD1401          | id → {message, id_user_sender, id_user_receiver, publish_date} |
| **Normal Form** | BCNF                            |

<br></br>

| **TABLE R15**   | Group                           |
| --------------  | ---                             |
| **Keys**        | { id }                          |
| **Functional Dependencies:** |                    |    
| FD1501          | id → {name, description}        |
| **Normal Form** | BCNF                            |

<br></br>

| **TABLE R16**   | UserGroupModerator                  |
| --------------  | ---                                 |
| **Keys**        | { id_group, id_user_moderator }     |
| **Functional Dependencies:** |  none                  |
| **Normal Form** | BCNF                                |

<br></br>

| **TABLE R17**   | UserGroupMember                 |
| --------------  | ---                             |
| **Keys**        | { id_group, id_user_member  }   |
| **Functional Dependencies:** |  none              |
| **Normal Form** | BCNF                            |

<br></br>

| **TABLE R18**   | Interest                        |
| --------------  | ---                             |
| **Keys**        | { id }                          |
| **Functional Dependencies:** |                    |
| FD1801          | id → {name, description}        |
| **Normal Form** | BCNF                            |

<br></br>

| **TABLE R19**   | InterestUser                    |
| --------------  | ---                             |
| **Keys**        | { id_interest , id_user   }     |
| **Functional Dependencies:** |  none              |
| **Normal Form** | BCNF                            |    

<br></br>

| **TABLE R20**   | Locale                      |
| --------------  | ---                         |
| **Keys**        | { id }                      |
| **Functional Dependencies:** |                |
| FD2001          | id → {region, id_country}   |
| **Normal Form** | BCNF                        |

<br></br>

| **TABLE R21**   | Country                     |
| --------------  | ---                         |
| **Keys**        | { id }, {iso_3166}          |
| **Functional Dependencies:** |                |
| FD2101          | id → {iso_3166, name}       |
| FD2102          | iso_3166 → {id, name}       |
| **Normal Form** | BCNF                        |

<br></br>

| **TABLE R22**   | Notification                |
| --------------  | ---                         |
| **Keys**        | { id }                      |
| **Functional Dependencies:** |                |
| FD2201          | id → {id_user, read}        |
| **Normal Form** | BCNF                        |

<br></br>

| **TABLE R23**   | LikeNotification                        |
| --------------  | ---                                     |
| **Keys**        | { id_notification }                     |
| **Functional Dependencies:** |                            |
| FD2301          | id_notification → {id_like}             |
| **Normal Form** | BCNF                                    |

<br></br>

| **TABLE R24**   | ReplyNotification                       |
| --------------  | ---                                     |
| **Keys**        | { id_notification }                     |
| **Functional Dependencies:** |  none                      |
| **Normal Form** | BCNF                                    |

<br></br>

| **TABLE R25**   | FriendRequestNotification               |
| --------------  | ---                                     |
| **Keys**        | { id_notification }                     |
| **Functional Dependencies:** |                            |
| FD2501          | id_notification → {id_friend_request}   |
| **Normal Form** | BCNF                                    |

<br></br>

| **TABLE R26**   | CommentReplyNotification                |
| --------------  | ---                                     |
| **Keys**        | { id_notification }                     |
| **Functional Dependencies:** |                            |
| FD2601          | id_notification → {id_comment}          |
| **Normal Form** | BCNF                                    |

<br></br>

| **TABLE R27**   | TextContentReplyNotification            |
| --------------  | ---                                     |
| **Keys**        | { id_notification }                     |
| **Functional Dependencies:** |                            |
| FD2701          | id_notification → {id_text_content}     |
| **Normal Form** | BCNF                                    |

<br></br>

| **TABLE R28**   | PaymentMethod                           |
| --------------  | ---                                     |
| **Keys**        | { id }                                  |
| **Functional Dependencies:** |                            |
| FD2801          | id → {name, company, transaction_limit} |
| **Normal Form** | BCNF                                    |

<br></br>

| **TABLE R29**   | Campaign                            |
| --------------  | ---                                 |
| **Keys**        | { id_media_content }                |
| **Functional Dependencies:** |                        |
| FD2901          | id_media_content → {id_advertiser, starting_date, finishing_date, budget, remaining_budget, impressions, clicks}          |
| **Normal Form** | BCNF                                |

<br></br>

| **TABLE R30**   | GameSession                         |
| --------------  | ---                                 |
| **Keys**        | { id }                              |
| **Functional Dependencies:** |                        |
| FD3001          | id → {session_title}                |
| **Normal Form** | BCNF                                |

<br></br>

| **TABLE R31**   | GameStats                           |
| --------------  | ---                                 |
| **Keys**        | { id_user }                         |
| **Functional Dependencies:** |                        |
| FD3101          | id_user → {id_game_session, score}  |
| **Normal Form** | BCNF                                |

<br></br>

| **TABLE R32**   | AcceptedFriendRequest               |
| --------------  | ---                                 |
| **Keys**        | { id_friend_request }               |
| **Functional Dependencies:** |                        |
| FD3201          | id_friend_request → {accepted_date} |
| **Normal Form** | BCNF                                |

<br></br>

| **TABLE R33**   | RejectedFriendRequest               |
| --------------  | ---                                 |
| **Keys**        | { id_friend_request }               |
| **Functional Dependencies:** |                        |
| FD3301          | id_friend_request → {reject_date}   |
| **Normal Form** | BCNF                                |

<br></br>

| **TABLE R34**   | Friends                             |
| --------------  | ---                                 |
| **Keys**        | { id_user1 , id_user2 }             |
| **Functional Dependencies:** |  none                  |
| **Normal Form** | BCNF                                |

<br></br>

Note: Because all relations are in the Boyce–Codd Normal Form (BCNF), the relational schema is also in the BCNF and, therefore, the schema does not need to be further normalised. 

---


## A6: Indexes, triggers, transactions and database population

This artefact encapsulates the physical schema of the database, containing the description and implementation of the indexes, triggers and transactions of the database.
This artefact also contains the database's workload as well as the complete database creation script, including all SQL necessary to define all integrity constraints, indexes and triggers. Finally, this artefact also includes a separate script with INSERT statements to populate the database.

### 1. Database Workload

| **Relation reference** | **Relation Name** | **Order of magnitude**  | **Estimated growth** |
| ------------------ | ---------------------------- | ----- | ---------  |
| R01                | Users                        | 10 k  | 100 / day  |
| R02                | AdminUser                    | 10    | no growth  |
| R03                | Advertiser                   | 1 k   | 10 / day   |
| R04                | Wallet                       | 1 k   | 10 / day   |
| R05                | Content                      | 100 k | 1 k / day  |
| R06                | ContentLikes                 | 1 M   | 10 k / day |
| R07                | TextContent                  | 100 k | 1 k / day  |
| R08                | TextReply                    | 100 k | 100 / day  |
| R09                | MediaContent                 | 100 k | 1 k / day  |
| R10                | Video                        | 10 k  | 100 / day  |
| R11                | Image                        | 100 k | 100 / day  |
| R12                | Comment                      | 100 k | 1 k / day  |
| R13                | FriendRequest                | 100 k | 1 k / day  |
| R14                | Message                      | 100 k | 10 k / day |
| R15                | Group                        | 1 k   | 10 / day   |
| R16                | UserGroupModerator           | 1 k   | 10 / day   |
| R17                | UserGroupMember              | 100 k | 1 k / day  |
| R18                | Interest                     | 100   | no growth  |
| R19                | InterestUser                 | 100 k | 100 / day  |
| R20                | Locale                       | 100 k | no growth  |
| R21                | Country                      | 100   | no growth  |
| R22                | Notification                 | 100 k | 10 k / day |
| R23                | LikeNotification             | 10 k  | 1 k / day  |
| R24                | ReplyNotification            | 10 k  | 1 k / day  |
| R25                | FriendRequestNotification    | 10 k  | 1 k / day  |
| R26                | CommentReplyNotification     | 10 k  | 1 k / day  |
| R27                | TextContentReplyNotification | 10 k  | 1 k / day  |
| R28                | PaymentMethod                | 1     | no growth  |
| R29                | Campaign                     | 1 k   | 10 / day   |
| R30                | GameSession                  | 1 k   | 10 / day   |
| R31                | GameStats                    | 10 k  | 100 / day  |
| R32                | AcceptedFriendRequest        | 10 k  | 1 k / day  |
| R33                | RejectedFriendRequest        | 10 k  | 1 k / day  |
| R34                | Friends                      | 100 k | 1 k / day  |


### 2. Proposed Indices

#### 2.1. Performance Indices
 

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | Content                                |
| **Attribute**       | id_creator                             |
| **Type**            | Hash                                   |
| **Cardinality**     | Medium                                 |
| **Clustering**      | No                                     |
| **Justification**   | Accessing the content posted by a specific user is one of the most important features in a social network and, as such, many queries will filter access to Content by it's creator. For instance this is useful for displaying a user's timeline. It's a hash type index, because we want an exact match when searching for posts from one user. Clustering would be good for performance, but update frequency can be high seeing as an user can, for example, post new content many times a day.             |
| **SQL code** |`CREATE INDEX user_content ON Content USING hash (id_creator);`|

<br></br>

| **Index**           | IDX02                                  |
| ---                 | ---                                    |
| **Relation**        | MediaContent                           |
| **Attribute**       | id_locale                              |
| **Type**            | B-tree                                 |
| **Cardinality**     | Medium                                 |
| **Clustering**      | Yes                                    |
| **Justification**   | Wanting to search MediaContent with a particular location tag is also a very common requirement in a social platform. As such we want said filtering to be done as quick as possible. We plan to have the locations on our database since the very start, there will be next to none additions of new locations. With such a low update frequency paired with a medium cardinality, this is a perfect candidate for Clustering.         |
| **SQL code** |`CREATE INDEX mediacontent_location ON MediaContent USING btree (id_locale); CLUSTER MediaContent USING mediacontent_location;`|

<br></br>

| **Index**           | IDX03                                  |
| ---                 | ---                                    |
| **Relation**        | Campaign                               |
| **Attribute**       | finishing_date                         |
| **Type**            | B-tree                                 |
| **Cardinality**     | Medium                                 |
| **Clustering**      | No                                     |
| **Justification**   | It's very frequent to access the table "Campaign" for promotions ending on a given date. A B-tree index allows for efficient data range queries based on the finishing_date     |
| **SQL code** |`CREATE INDEX end_campaign ON Campaign USING btree (finishing_date);`|

<br></br>

#### 2.2. Full-text Search Indices 
  

| **Index**           | IDX11                                  |
| ---                 | ---                                    |
| **Relation**        | TextReply                              |
| **Attribute**       | child_text, parent_text                |
| **Type**            | GIN                                    |
| **Clustering**      | No                                     |
| **Justification**   | To provide full-text search features to look for TextReplies based on matching child_text or parent_text. The index type is GIN because the indexed fields generally won't change after the first insertion.   |
| **SQL code**        | 

```
-- Add column to TextReply to store computed ts_vectors.
ALTER TABLE TextReply
ADD COLUMN tsvectors TSVECTOR;

-- Create a function to automatically update ts_vectors.
CREATE FUNCTION textreply_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
         setweight(to_tsvector('english', NEW.child_text), 'A') ||
         setweight(to_tsvector('english', NEW.parent_text), 'B')
        );
 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.child_text <> OLD.child_text OR NEW.parent_text <> OLD.parent_text) THEN
           NEW.tsvectors = (
             setweight(to_tsvector('english', NEW.child_text), 'A') ||
             setweight(to_tsvector('english', NEW.parent_text), 'B')
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
```


<br></br>

| **Index**           | IDX12                                  |
| ---                 | ---                                    |
| **Relation**        | MediaContent                           |
| **Attribute**       | description                            |
| **Type**            | GIN                                    |
| **Clustering**      | No                                     |
| **Justification**   | To provide full-text search features to look for MediaContent based on matching description. The index type is GIN because the indexed fields generally won't change after the first insertion.   |
| **SQL code**         | 

```
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
```

<br></br>

### 3. Triggers

| **Trigger**      | TRIGGER01                              |
| ---              | ---                                    |
| **Description**  | A comment's date must be later than the publishing date of its corresponding media content. |
| **SQL code**               |

```
CREATE FUNCTION dateComment() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF ((SELECT publishing_date FROM Content WHERE id == NEW.id_media_content)> NEW.comment_date) RAISE EXCEPTION 'Content date greater than Comment date';
   END IF;
   RETURN NEW;
END;
$$;

CREATE TRIGGER dateComment
   BEFORE INSERT ON Comment
   EXECUTE PROCEDURE dateComment();
```

<br></br>

| **Trigger**      | TRIGGER02                              |
| ---              | ---                                    |
| **Description**  | The date of a text reply must be later than the publishing date of its parent text content |
| **SQL code**             |

```
CREATE FUNCTION dateText() RETURNS TRIGGER LANGUAGE plpgsql AS
$$
BEGIN
   IF ((SELECT publishing_date FROM Content WHERE id == (SELECT id_content FROM TextContent WHERE id == child_text)) <= (SELECT publishing_date FROM Content WHERE id == (SELECT id_content FROM TextContent WHERE id == parent_text))) RAISE EXCEPTION 'Parent reply date greater than child date';
   END IF;
END;
$$;

CREATE TRIGGER dateText
   BEFORE INSERT TextReply
   EXECUTE PROCEDURE dateText();
```

<br></br>

### 4. Transactions

| **Transaction**   | TRAN01                    |
| --------------- | ----------------------------------- |
| **Description** | Get the count of all text posts, as well as information about the last ones |
| **Justification**   | The insertion of new rows in the Content table can occur in the middle of the transaction, which may result in the information retrieved in both selects to be different, consequently resulting in a Phantom Read. It's READ ONLY because it only uses Selects.  |
| **Isolation level** | SERIALIZABLE READ ONLY |
| Complete SQL Code                                   ||

```
a
```

<br></br>

| **Transaction**   | TRAN02                                 |
| ---------------   | -----------------------------------    |
| **Description**   | Get the count of all text posts, as well as information about the last ones |
| **Justification**   | The insertion of new rows in the Content table can occur in the middle of the transaction, which may result in the information retrieved in both selects to be different, consequently resulting in a Phantom Read. It's READ ONLY because it only uses Selects.  |
| **Isolation level** | SERIALIZABLE READ ONLY |
| Complete SQL Code                                   ||

```
a
```

<br></br>

## Annex A. SQL Code

### A.1. Database schema

### A.2. Database population


---

***
GROUP2121, 30/11/2021

* Francisco Pires, up201908044@up.pt 
* José Pedro Ferreira, up201904515@up.pt (Editor)
* Lucas Calvet Santos, up201904517@up.pt
* Sérgio da Gama, up201906690@up.pt
