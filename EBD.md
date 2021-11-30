# EBD: Database Specification Component

> Project vision.

## A4: Conceptual Data Model

> Brief presentation of the artefact goals.

### 1. Class diagram

> UML class diagram containing the classes, associations, multiplicity and roles.  
> For each class, the attributes, associations and constraints are included in the class diagram.

### 2. Additional Business Rules
 
> Business rules can be included in the UML diagram as UML notes or in a table in this section.


---


## A5: Relational Schema, validation and schema refinement

> Brief presentation of the artefact goals.

### 1. Relational Schema

> The Relational Schema includes the relation schemas, attributes, domains, primary keys, foreign keys and other integrity rules: UNIQUE, DEFAULT, NOT NULL, CHECK.  
> Relation schemas are specified in the compact notation:  

| Relation reference | Relation Compact Notation                        |
| ------------------ | ------------------------------------------------ |
| R01                | Users(__id__, username __UK__ __NN__, name __NN__, email __UK__ __NN__, hashed_password __NN__, profile_picture __NN__, cover_picture __NN__, phone_number, id_country → Country __NN__, birthday __NN__)                     |
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
| R14                | Message(__id__, message __NN__, id_user_sender → Users __NN__, id_user_receiver → Users __NN__, publish_date)   |
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
| R29                | Campaign(__id_media_content__ → MediaContent, id_advertiser → Advertiser __NN__, starting_date __NN__, finishing_date __NN__ __CK__ finishing_date > starting_date, budget, remaining_budget __CK__ remaining_budget <= budget, impressions, clicks)   |
| R30                | GameSession(__id__, session_title __NN__)    |
| R31                | GameStats(__id_user__ → Users, id_game_session → GameSession __NN__, score __NN__)  |
| R32                | AcceptedFriendRequest(__id_friend_request__ → FriendRequest, accepted_date) |
| R33                | RejectedFriendRequest(__id_friend_request__ → FriendRequest, rejected_date) |
| R34                | Friends(__id_user1__ → Users, __id_user2__ → Users, __CK__ id_user1 > id_user2) | 

### 2. Domains

> The specification of additional domains can also be made in a compact form, using the notation:  

| Domain Name | Domain Specification           |
| ----------- | ------------------------------ |
| Today	      | DATE DEFAULT CURRENT_DATE      |
| Priority    | ENUM ('High', 'Medium', 'Low') |

### 3. Schema validation

> To validate the Relational Schema obtained from the Conceptual Model, all functional dependencies are identified and the normalization of all relation schemas is accomplished. Should it be necessary, in case the scheme is not in the Boyce–Codd Normal Form (BCNF), the relational schema is refined using normalization.  

| **TABLE R01**   | User               |
| --------------  | ---                |
| **Keys**        | { id }, { email }, { username } |
| **Functional Dependencies:** |       |
| FD0101          | id → {email, username, name, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday} |
| FD0102          | email → {id, usernamename, name, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday} |
| FD0103          | username → {id, email, name, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R02**   | AdminUser               |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |  none |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R03**   | Advertiser           |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD0301          | id → {company_name, id_wallet} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R04**   | Wallet           |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD0401          | id → {budget} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R05**   | Content           |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD0501          | id → {publishing_date, id_group, id_creator} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R06**   | ContentLikes       |
| --------------  | ---                |
| **Keys**        | { id_user, id_content } |
| **Functional Dependencies:** |       |
| FD0601          | { id_user, id_content } → {date} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R07**   | TextContent           |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD0701          | id → {post_text, id_content} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R08**   | TextReply          |
| --------------  | ---                |
| **Keys**        | { child_text } |
| **Functional Dependencies:** |       |
| FD0801          | child_text → {parent_text} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R09**   | MediaContent       |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD0901          | id → {description, media, fullscreen, id_content, id_locale} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R10**   | Video       |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD1001          | id → {title, size, quality, views, id_media_content} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R11**   | Image       |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD1101          | id → {alt_text, width, height, id_media_content} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R12**   | Comment       |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD1201          | id → {comment_text, comment_date, author, id_media_content} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R13**   | FriendRequest       |
| --------------  | ---                |
| **Keys**        | { id_user_from, id_user_to } |
| **Functional Dependencies:** |       |
| FD1301          | { id_user_from, id_user_to } → {creation, state} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R14**   | Message       |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD1401          | id → {message, id_user_sender, id_user_receiver, publish_date} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R15**   | Group       |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD1501          | id → {name, description} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R16**   | UserGroupModerator               |
| --------------  | ---                |
| **Keys**        | { id_group, id_user_moderator } |
| **Functional Dependencies:** |  none |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R17**   | UserGroupMember               |
| --------------  | ---                |
| **Keys**        | { id_group, id_user_member  } |
| **Functional Dependencies:** |  none |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R18**   | Interest       |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD1801          | id → {name, description} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R19**   | InterestUser               |
| --------------  | ---                |
| **Keys**        | { id_interest , id_user   } |
| **Functional Dependencies:** |  none |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R20**   | Locale       |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD2001          | id → {region, id_country} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R21**   | Country       |
| --------------  | ---                |
| **Keys**        | { id }, {iso_3166} |
| **Functional Dependencies:** |       |
| FD2101          | id → {iso_3166, name} |
| FD2102          | iso_3166 → {id, name} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R22**   | Notification       |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD2201          | id → {id_user, read} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R23**   | LikeNotification    |
| --------------  | ---                |
| **Keys**        | { id_notification } |
| **Functional Dependencies:** |       |
| FD2301          | id_notification → {id_like} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R24**   | ReplyNotification               |
| --------------  | ---                |
| **Keys**        | { id_notification } |
| **Functional Dependencies:** |  none |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R25**   | FriendRequestNotification    |
| --------------  | ---                |
| **Keys**        | { id_notification } |
| **Functional Dependencies:** |       |
| FD2501          | id_notification → {id_friend_request} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R26**   | CommentReplyNotification    |
| --------------  | ---                |
| **Keys**        | { id_notification } |
| **Functional Dependencies:** |       |
| FD2601          | id_notification → {id_comment} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R27**   | TextContentReplyNotification    |
| --------------  | ---                |
| **Keys**        | { id_notification } |
| **Functional Dependencies:** |       |
| FD2701          | id_notification → {id_text_content} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R28**   | PaymentMethod    |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD2801          | id → {name, company, transaction_limit} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R29**   | Campaign    |
| --------------  | ---                |
| **Keys**        | { id_media_content } |
| **Functional Dependencies:** |       |
| FD2901          | id_media_content → {id_advertiser, starting_date, finishing_date, budget, remaining_budget, impressions, clicks} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R30**   | GameSession    |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD3001          | id → {session_title} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R31**   | GameStats    |
| --------------  | ---                |
| **Keys**        | { id_user } |
| **Functional Dependencies:** |       |
| FD3101          | id_user → {id_game_session, score} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R32**   | AcceptedFriendRequest   |
| --------------  | ---                |
| **Keys**        | { id_friend_request } |
| **Functional Dependencies:** |       |
| FD3201          | id_friend_request → {accepted_date} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R33**   | RejectedFriendRequest    |
| --------------  | ---                |
| **Keys**        | { id_friend_request } |
| **Functional Dependencies:** |       |
| FD3301          | id_friend_request → {reject_date} |
| **Normal Form** | BCNF               |

<br></br>

| **TABLE R34**   | Friends               |
| --------------  | ---                |
| **Keys**        | { id_user1 , id_user2 } |
| **Functional Dependencies:** |  none |
| **Normal Form** | BCNF               |

<br></br>

> If necessary, description of the changes necessary to convert the schema to BCNF.  
> Justification of the BCNF.  


---


## A6: Indexes, triggers, transactions and database population

> Brief presentation of the artefact goals.

### 1. Database Workload
 
> A study of the predicted system load (database load).
> Estimate of tuples at each relation.

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
 
> Indices proposed to improve performance of the identified queries.

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | Relation where the index is applied    |
| **Attribute**       | Attribute where the index is applied   |
| **Type**            | B-tree, Hash, GiST or GIN              |
| **Cardinality**     | Attribute cardinality: low/medium/high |
| **Clustering**      | Clustering of the index                |
| **Justification**   | Justification for the proposed index   |
| `SQL code`                                                  ||

> Analysis of the impact of the performance indices on specific queries.
> Include the execution plan before and after the use of indices.

| **Query**       | SELECT01                               |
| ---             | ---                                    |
| **Description** | One sentence describing the query goal |
| `SQL code`                                              ||
| **Execution Plan without indices**                      ||
| `Execution plan`                                        ||
| **Execution Plan with indices**                         ||
| `Execution plan`                                        ||


#### 2.2. Full-text Search Indices 

> The system being developed must provide full-text search features supported by PostgreSQL. Thus, it is necessary to specify the fields where full-text search will be available and the associated setup, namely all necessary configurations, indexes definitions and other relevant details.  

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | Relation where the index is applied    |
| **Attribute**       | Attribute where the index is applied   |
| **Type**            | B-tree, Hash, GiST or GIN              |
| **Clustering**      | Clustering of the index                |
| **Justification**   | Justification for the proposed index   |
| `SQL code`                                                  ||


### 3. Triggers
 
> User-defined functions and trigger procedures that add control structures to the SQL language or perform complex computations, are identified and described to be trusted by the database server. Every kind of function (SQL functions, Stored procedures, Trigger procedures) can take base types, composite types, or combinations of these as arguments (parameters). In addition, every kind of function can return a base type or a composite type. Functions can also be defined to return sets of base or composite values.  

| **Trigger**      | TRIGGER01                              |
| ---              | ---                                    |
| **Description**  | Trigger description, including reference to the business rules involved |
| `SQL code`                                             ||

### 4. Transactions
 
> Transactions needed to assure the integrity of the data.  

| SQL Reference   | Transaction Name                    |
| --------------- | ----------------------------------- |
| Justification   | Justification for the transaction.  |
| Isolation level | Isolation level of the transaction. |
| `Complete SQL Code`                                   ||


## Annex A. SQL Code

> The database scripts are included in this annex to the EBD component.
> 
> The database creation script and the population script should be presented as separate elements.
> The creation script includes the code necessary to build (and rebuild) the database.
> The population script includes an amount of tuples suitable for testing and with plausible values for the fields of the database.
>
> This code should also be included in the group's git repository and links added here.

### A.1. Database schema

### A.2. Database population


---


## Revision history

Changes made to the first submission:
1. Item 1
1. ..

***
GROUP21gg, DD/MM/2021
 
* Group member 1 name, email (Editor)
* Group member 2 name, email
* ...
