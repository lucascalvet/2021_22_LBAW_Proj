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
| R01                | Users(__id__, username UK NN, name NN, email UK NN, hashed_password NN, profile_picture NN, cover_picture NN, phone_number, id_country NN, birthday NN)                     |
| R02                | AdminUser(__id__)  |
| R03                | Advertiser(__id__, company_name NN, id_wallet NN)  |
| R04                | Wallet(__id__, budget NN) |
| R05                | Content(__id__, publishing_date NN, id_group, id_creator NN)            |
| R06                | ContentLikes(__id_user NN__ → Users, __id_content NN__ → Content, date) |
| R07                | TextContent(__id__, post_text NN, id_content)    |
| R08                | TextReply(__child_text__, parent_text NN)    |
| R09                | MediaContent(__id__, description NN, media NN, fullscreen, id_content NN, id_locale)            |
| R10                | Video(__id__, title NN, size, quality, views, id_media_content NN)            |
| R11                | Image(__id__, alt_text NN, width, height, id_media_content NN)  |
| R12                | Comment(__id__, comment_text NN, comment_date, author NN, id_media_content NN) |
| R13                | FriendRequest(__id_user_from NN, id_user_to NN__, creation NN, state)                     |
| R14                | Message(__id__, message NN, id_user_sender NN, id_user_receiver NN, publish_date)   |
| R15                | Group(__id__, name NN, description)   |
| R16                | UserGroupModerator(__id_group NN, id_user_moderator NN__)   |
| R17                | UserGroupMember(__id_group NN, id_user_member NN__)   |
| R18                | Interest(__id__, name NN, description NN)                     |
| R19                | InterestUser(__id_interest NN, id_user NN__)                     |
| R20                | Locale(__id__, region NN, id_country NN)            |
| R21                | Country(__id__, iso_3166 UK, name NN)   |
| R22                | Notification(__id__, id_user NN, read) |
| R23                | LikeNotification(__id_notification__, id_like NN) |
| R24                | ReplyNotification(__id_notification__) |
| R25                | FriendRequestNotification(__id_notification__, id_friend_request NN)  |
| R26                | CommentReplyNotification(__id_notification__, id_comment NN) |
| R27                | TextContentReplyNotification(__id_notification__, id_text_content NN) |
| R28                | PaymentMethod(__id__, name NN, company NN, transaction_limit NN) |
| R29                | Campaign(__id_media_content__, id_advertiser NN, starting_date NN, finishing_date NN, budget, remaining_budget, impressions, clicks)   |
| R30                | GameSession(__id__, session_title NN)    |
| R31                | GameStats(__id_user__, id_game_session NN, score NN)  |

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
| ...             | ...                |
| **NORMAL FORM** | BCNF               |

| **TABLE R02**   | AdminUser               |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |  none |
| **NORMAL FORM** | BCNF               |

| **TABLE R03**   | Advertiser           |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD0301          | id → {company_name, id_wallet} |
| ...             | ...                |
| **NORMAL FORM** | BCNF               |

| **TABLE R04**   | Wallet           |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD0401          | id → {budget} |
| ...             | ...                |
| **NORMAL FORM** | BCNF               |

| **TABLE R05**   | Content           |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD0501          | id → {publishing_date, id_group, id_creator} |
| ...             | ...                |
| **NORMAL FORM** | BCNF               |

| **TABLE R06**   | ContentLikes        |
| --------------  | ---                |
| **Keys**        | { id_user, id_content } |
| **Functional Dependencies:** |       |
| FD0501          | { id_user, id_content } → {date} |
| ...             | ...                |
| **NORMAL FORM** | BCNF               |


















> If necessary, description of the changes necessary to convert the schema to BCNF.  
> Justification of the BCNF.  


---


## A6: Indexes, triggers, transactions and database population

> Brief presentation of the artefact goals.

### 1. Database Workload
 
> A study of the predicted system load (database load).
> Estimate of tuples at each relation.

| **Relation reference** | **Relation Name** | **Order of magnitude**        | **Estimated growth** |
| ------------------ | ------------- | ------------------------- | --------- |
| R01                | Table1        | units|dozens|hundreds|etc | order per time |
| R02                | Table2        | units|dozens|hundreds|etc | dozens per month |
| R03                | Table3        | units|dozens|hundreds|etc | hundreds per day |
| R04                | Table4        | units|dozens|hundreds|etc | no growth |


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
