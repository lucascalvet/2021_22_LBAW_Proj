--SET Search.path lbaw2121;

--PRAGMA foreign_keys=ON;

--Country: 11
--Locale: 11
--Users: 20
--Admin: 1
--Wallet: 10
--Advertisers: 10
--Content: 10
--ContentLike: 10
--TextContent: 5
--TextReply: 2
--MediaContent: 5
--Video: 2
--Image: 3
--Comment: 5
--FriendRequest: 5
--AcceptedFriendRequest: 3
--RejectedFriendRequest: 2
--Message: 5
--Groups: 2
--UserGroupModerator: 1
--UserGroupMember: 5
--Interest: 5
--InterestUser: 3
--Notification: 6
--LikeNotification: 2
--ReplyNotification: 2
--FriendRequestNotification: 2
--CommentReplyNotification: 1
--TextContentReplyNotification: 1
--PaymentMethod: 1
--Campaign: 2
--GameSession: 2
--GameStats: 6

--Alpha-3 code
INSERT INTO Country (id, iso_3166, name) VALUES (1, 'AFG', 'Afghanistan');
INSERT INTO Country (id, iso_3166, name) VALUES (2, 'ALA', 'Åland Islands');
INSERT INTO Country (id, iso_3166, name) VALUES (3, 'ALB', 'Albania');
INSERT INTO Country (id, iso_3166, name) VALUES (4, 'DZA', 'Algeria');
INSERT INTO Country (id, iso_3166, name) VALUES (5, 'ASM', 'American Samoa');
INSERT INTO Country (id, iso_3166, name) VALUES (6, 'AND', 'Andorra');
INSERT INTO Country (id, iso_3166, name) VALUES (7, 'AGO', 'Angola');
INSERT INTO Country (id, iso_3166, name) VALUES (8, 'AIA', 'Anguilla');
INSERT INTO Country (id, iso_3166, name) VALUES (9, 'ATA', 'Antarctica');
INSERT INTO Country (id, iso_3166, name) VALUES (10, 'ATG', 'Antigua and Barbuda');
INSERT INTO Country (id, iso_3166, name) VALUES (11, 'PRT', 'Portugal');

INSERT INTO Locale (id, region, id_country) VALUES (1, 'Badakhshan', 1);
INSERT INTO Locale (id, region, id_country) VALUES (2, 'Jomala', 2);
INSERT INTO Locale (id, region, id_country) VALUES (3, 'Kavaje', 3);
INSERT INTO Locale (id, region, id_country) VALUES (4, 'Adrar', 4);
INSERT INTO Locale (id, region, id_country) VALUES (5, 'Fagatogo', 5);
INSERT INTO Locale (id, region, id_country) VALUES (6, 'Andorra-a-Velha', 6);
INSERT INTO Locale (id, region, id_country) VALUES (7, 'Luanda', 7);
INSERT INTO Locale (id, region, id_country) VALUES (8, 'Vale', 8);
INSERT INTO Locale (id, region, id_country) VALUES (9, 'Antarctica', 9);
INSERT INTO Locale (id, region, id_country) VALUES (10, 'Saint John', 10);
INSERT INTO Locale (id, region, id_country) VALUES (11, 'Porto', 11);

--passwords in sha256
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (1, 'Evernshould', 'Evelyn M. Dudley', 'EvelynMDudley@rhyta.com', '6D11B2A042B62DCC2CB661382637D178C07C4056A22730E223CFF92D2059EA9B', NULL, NULL, '561-265-2290', 1, '1956-3-4'); --ieSuo8Quu
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (2, 'Prabovers', 'David N. Thomas', 'DavidNThomas@jourrapide.com', 'F59B7176818F1BFEA97A9FF8FDC6F04DC5CC6615CF9EA0E3F509481F2E786FB0', NULL, NULL, '561-883-6567', 1, '1988-2-13'); --Ahn5ieze0oKoh
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (3, 'Rivinquister', 'Robert A. West', 'RobertAWest@armyspy.com', 'C95D8CD924E48C3C9433A22EC9D8DD22795866858737248190E73DC48799C017', NULL, NULL, '616-261-7167', 2, '1962-10-20'); --foiKeigio6Qu
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (4, 'Hoppled91', 'Isaac K. Spencer', 'IsaacKSpencer@dayrep.com', '14390CB20A1DC17AA2A1973F220E21104739D51AC67AFF4B1119F20D6D50FDC2', NULL, NULL, '914-964-9238', 2, '1991-8-6'); --Aagh4pe9V
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (5, 'Ingled91', 'Tim K. Gutierrez', 'TimKGutierrez@teleworm.us', '98730C61AA5B1910D64C8F0B18A821EDDB4FFF8C6E6DD7958E0B084C740156AE', NULL, NULL, '270-379-5170', 3, '1991-10-28'); --coh6IkifuNg
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (6, 'Daimpas1985', 'William T. Hancock', 'WilliamTHancock@jourrapide.com', '2EABCB5906D8F75EFABFD13A4FF1C0D992AF886F8CBBF32F141C7BA7955F65BE', NULL, NULL, '504-491-4903', 3, '1985-7-13'); --Eophee9ie
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (7, 'Forneved', 'Paul J. Gillen', 'PaulJGillen@jourrapide.com', '7717344433C8E44299CFED10EF60040CDDAE738398FF45CA18921F383997CF21', NULL, NULL, '203-509-4665', 4, '1947-10-27'); --aith9Esiez
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (8, 'Stoonce', 'Clarence S. Catron', 'ClarenceSCatron@teleworm.us', '91A38859109D26212025860C49D8380697B1EA3AA92FEB8705F85A693AA07B52', NULL, NULL, '406-775-1564', 4, '1995-4-20'); --PoTh2ooxa4
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (9, 'Walcon', 'Susanne M. Miller', 'SusanneMMiller@dayrep.com', '7AA3E41B2285E6455CCD7DFEDC60059060D6BA1D94545EDA5F55A83F41AF25C8', NULL, NULL, '631-444-4388', 5, '1986-11-29'); --Thae5ait
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (10, 'Museltole', 'John K. Shuman', 'JohnKShuman@jourrapide.com', '57188DEC4E8D472BCF9287CDAFAEA85852C9761155DA127C4E235B1F35795B51', NULL, NULL, '919-484-3756', 5, '1983-9-22'); --aeGo3yu6Iy
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (11, 'Hatecrable2000', 'Jeniffer J. Parsons', 'JenifferJParsons@teleworm.us', 'B49A326321C9AD9DCCF83480F4DBE3212E8BEB7E58F07DFC6FE00C3A1784E59E', NULL, NULL, '814-845-9721', 6, '2000-3-1'); --vu0eiKa7ae
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (12, 'Dights1956', 'Kim B. McClain', 'KimBMcClain@teleworm.us', '6AB2DA5D0F8012A27FE3964337C4614CF129551E124D6AD0AB2F5B6DEFEDCE89', NULL, NULL, '702-243-7350', 6, '1956-12-17'); --ajaiz6Joo
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (13, 'Examated', 'Casey J. Russo', 'CaseyJRusso@jourrapide.com', 'A903139300286AF21144CC0989FFC87438DC0F00E588F0B74C1663CA29DC064B', NULL, NULL, '314-765-9362', 7, '1996-8-24'); --Ui2thoh5
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (14, 'Thenly', 'Ines C. Yancey', 'InesCYancey@jourrapide.com', '0614C6A60BEA45F620702CCE6FA0521353AB04A41CFFB2E8B963447331D3A295', NULL, NULL, '203-736-5651', 7, '1992-4-27'); --aeR8om1ph
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (15, 'Caus1973', 'Patricia E. Horton', 'PatriciaEHorton@teleworm.us', 'B76989C2EECEF1D5CBF94D061B8FF412922272F847AC0B6B688EDE96784FE327', NULL, NULL, '336-750-8290', 8, '1973-7-23'); --eedaing7Od
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (16, 'Lighbothe', 'Cathy F. McBride', 'CathyFMcBride@jourrapide.com', '225BC524F50F2BB9262520BCAD32D3B216A70BCA01B91BA45AC9F2E0C03D4205', NULL, NULL, '801-667-2817', 8, '1958-8-15'); --ieng7Ux5e
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (17, 'Hatumer', 'Betty R. Seamon', 'BettyRSeamon@rhyta.com', '11B7B0AEB1A643242492B42C49B68099312E27ADA1E58E5BB7F163D8CE6064A4', NULL, NULL, '302-570-5766', 9, '1985-11-8'); --zix0ephoh6C
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (18, 'Buls1950', 'Silvia P. Broadhurst', 'SilviaPBroadhurst@teleworm.us', '8A1D13FA55726E99053975912450EBA1EC4F41200E0E23CAFF3C588B86EE7256', NULL, NULL, '781-727-1458', 9, '1950-2-21'); --fa6ahThah2n
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (19, 'Ourne2001', 'Scott K. Goode', 'ScottKGoode@teleworm.us', '2E9C55D0178C30680ECDC2E30D209D118C1D5DA961E70982BA3BAE805867B3F0', NULL, NULL, '352-431-8723', 10, '2001-4-13'); --Igeki6weip
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (20, 'Miltary58', 'Carmela H. Choi', 'CarmelaHChoi@teleworm.us', '5EA9F7A0826D3C295919D6415E72DC415AF6AF3852ABAABE7D9FB7EC55C6C81E', NULL, NULL, '360-697-3591', 11, '1958-6-2'); --ha6zuoWee

INSERT INTO AdminUser (id_user) VALUES (1);
INSERT INTO AdminUser (id_user) VALUES (2);

INSERT INTO Wallet (id, budget) VALUES (1, 100);
INSERT INTO Wallet (id, budget) VALUES (2, 1000);
INSERT INTO Wallet (id, budget) VALUES (3, 10000);
INSERT INTO Wallet (id, budget) VALUES (4, 100000);
INSERT INTO Wallet (id, budget) VALUES (5, 500);
INSERT INTO Wallet (id, budget) VALUES (6, 5000);
INSERT INTO Wallet (id, budget) VALUES (7, 50000);
INSERT INTO Wallet (id, budget) VALUES (8, 200);
INSERT INTO Wallet (id, budget) VALUES (9, 2000);
INSERT INTO Wallet (id, budget) VALUES (10, 20000);

INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES (1, 'caes', 1);
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES (2, 'lightals', 2);
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES (3, 'videothings', 3);
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES (4, 'shoras', 4);
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES (5, 'ProductLoft', 5);
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES (6, 'buyables', 6);
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES (7, 'doores', 7);
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES (8, 'weons', 8);
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES (9, 'surfarts', 9);
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES (10, 'Diads', 10);

INSERT INTO Groups (id, name, description) VALUES (1, 'Game Development', 'Who doens t like games? Join Us');
INSERT INTO Groups (id, name, description) VALUES (2, 'Motards', 'We love bikes more than ourselves!');
INSERT INTO Groups (id, name, description) VALUES (3, 'Basketball', 'Kobe!!!!!');

INSERT INTO Content (id, publishing_date, id_group, id_creator) VALUES (1, '2021-5-23', NULL, 1);
INSERT INTO Content (id, publishing_date, id_group, id_creator) VALUES (2, '2015-7-28', 2, 2);
INSERT INTO Content (id, publishing_date, id_group, id_creator) VALUES (3, '2020-4-3', NULL, 3);
INSERT INTO Content (id, publishing_date, id_group, id_creator) VALUES (4, '2021-10-12', 1, 4);
INSERT INTO Content (id, publishing_date, id_group, id_creator) VALUES (5, '2019-1-10', NULL, 5);
INSERT INTO Content (id, publishing_date, id_group, id_creator) VALUES (6, '2018-9-20', NULL, 6);
INSERT INTO Content (id, publishing_date, id_group, id_creator) VALUES (7, '2021-5-7', NULL, 7);
INSERT INTO Content (id, publishing_date, id_group, id_creator) VALUES (8, '2020-2-16', 1, 8);
INSERT INTO Content (id, publishing_date, id_group, id_creator) VALUES (9, '2021-6-29', NULL, 9);
INSERT INTO Content (id, publishing_date, id_group, id_creator) VALUES (10, '2020-1-3', NULL, 10);

INSERT INTO ContentLike (date, id_user, id_content) VALUES ('2021-5-23', 1, 1);
INSERT INTO ContentLike (date, id_user, id_content) VALUES ('2015-7-28', 2, 2);
INSERT INTO ContentLike (date, id_user, id_content) VALUES ('2020-4-3', 3, 3);
INSERT INTO ContentLike (date, id_user, id_content) VALUES ('2021-10-12', 4, 4);
INSERT INTO ContentLike (date, id_user, id_content) VALUES ('2019-1-10', 5, 5);
INSERT INTO ContentLike (date, id_user, id_content) VALUES ('2018-9-20', 6, 6);
INSERT INTO ContentLike (date, id_user, id_content) VALUES ('2021-5-7', 7, 7);
INSERT INTO ContentLike (date, id_user, id_content) VALUES ('2020-2-16', 8, 8);
INSERT INTO ContentLike (date, id_user, id_content) VALUES ('2021-6-29', 9, 9);
INSERT INTO ContentLike (date, id_user, id_content) VALUES ('2020-1-3', 10, 10);

INSERT INTO TextContent (id, post_text, id_content) VALUES (1, 'Today i made a funny thing!', 1);
INSERT INTO TextContent (id, post_text, id_content) VALUES (2, 'I love to write SQL', 2);
INSERT INTO TextContent (id, post_text, id_content) VALUES (3, 'LBAW is the best course in the world', 3);
INSERT INTO TextContent (id, post_text, id_content) VALUES (4, 'What is the best football player?', 4);
INSERT INTO TextContent (id, post_text, id_content) VALUES (5, 'Take it easy, keep calm', 5);

INSERT INTO TextReply (child_text, parent_text) VALUES (1, 2);
INSERT INTO TextReply (child_text, parent_text) VALUES (4, 3);

INSERT INTO MediaContent (id, description, media, fullscreen, id_content, id_locale) VALUES (1, 'Just a cute video', '/cute.png', TRUE, 6, 1);
INSERT INTO MediaContent (id, description, media, fullscreen, id_content, id_locale) VALUES (2, 'BMW', '/moto.jpeg', FALSE, 7, 2);
INSERT INTO MediaContent (id, description, media, fullscreen, id_content, id_locale) VALUES (3, 'Mercedes', '/car.png', TRUE, 8, 3);
INSERT INTO MediaContent (id, description, media, fullscreen, id_content, id_locale) VALUES (4, 'Tutorial', '/tutorial.mp4', FALSE, 9, 4);
INSERT INTO MediaContent (id, description, media, fullscreen, id_content, id_locale) VALUES (5, 'Game', '/game.mp4', FALSE, 10, 5);

INSERT INTO Image (id, alt_text, width, height, id_media_content) VALUES (1, 'Cute', 200, 100, 1);
INSERT INTO Image (id, alt_text, width, height, id_media_content) VALUES (2, 'BMW', 300, 400, 2);
INSERT INTO Image (id, alt_text, width, height, id_media_content) VALUES (3, 'Mercedes', 500, 100, 3);

INSERT INTO Video (id, alt_text, views, id_media_content) VALUES (1, 'Tutorial', 100, 4);
INSERT INTO Video (id, alt_text, views, id_media_content) VALUES (2, 'Game', 300, 5);
INSERT INTO Video (id, alt_text, views, id_media_content) VALUES (3, 'Tankinix', 700, 3);

INSERT INTO Comment (id, comment_text, comment_date, author, id_media_content) VALUES (1, 'So cute!', '2021-10-11', 1, 1);
INSERT INTO Comment (id, comment_text, comment_date, author, id_media_content) VALUES (2, 'Very good brand', '2021-10-12', 2, 2);
INSERT INTO Comment (id, comment_text, comment_date, author, id_media_content) VALUES (3, 'I do not like that car', '2021-10-13', 3, 3);
INSERT INTO Comment (id, comment_text, comment_date, author, id_media_content) VALUES (4, 'Great tutorial', '2021-10-14', 4, 4);
INSERT INTO Comment (id, comment_text, comment_date, author, id_media_content) VALUES (5, 'I play this game all the time', '2021-10-15', 5, 5);
INSERT INTO Comment (id, comment_text, comment_date, author, id_media_content) VALUES (6, 'Best Dev Interview I have seen!', '2020-05-22', 5, 5);

INSERT INTO FriendRequest (id, creation, id_sender, id_receiver) VALUES (1, '2020-7-23', 1, 2);
INSERT INTO FriendRequest (id, creation, id_sender, id_receiver) VALUES (2, '2021-3-2', 1, 3);
INSERT INTO FriendRequest (id, creation, id_sender, id_receiver) VALUES (3, '2021-10-11', 3, 4);
INSERT INTO FriendRequest (id, creation, id_sender, id_receiver) VALUES (4, '2020-9-8', 4, 5);
INSERT INTO FriendRequest (id, creation, id_sender, id_receiver) VALUES (5, '2021-6-11', 6, 7);

INSERT INTO AcceptedFriendRequest (id_friend_request, accepted_date) VALUES (1, '2021-7-24');
INSERT INTO AcceptedFriendRequest (id_friend_request, accepted_date) VALUES (2, '2021-7-23');
INSERT INTO AcceptedFriendRequest (id_friend_request, accepted_date) VALUES (3, '2021-11-23');

INSERT INTO RejectedFriendRequest (id_friend_request, rejected_date) VALUES (4, '2021-10-23');
INSERT INTO RejectedFriendRequest (id_friend_request, rejected_date) VALUES (5, '2021-7-23');

INSERT INTO Message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (1, 'Hello', 1, 2, '2021-10-15');
INSERT INTO Message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (2, 'Hi', 2, 3, '2021-10-23');
INSERT INTO Message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (3, 'Can I ask you something?', 3, 4, '2021-10-27');
INSERT INTO Message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (4, 'Hey there!', 4, 5, '2021-10-3');
INSERT INTO Message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (5, 'I would like to meet you!', 5, 6, '2021-10-1');

INSERT INTO UserGroupModerator (id_group, id_user_moderator) VALUES (1, 1);

INSERT INTO UserGroupMember (id_group, id_user_member) VALUES (1, 1);
INSERT INTO UserGroupMember (id_group, id_user_member) VALUES (1, 3);
INSERT INTO UserGroupMember (id_group, id_user_member) VALUES (2, 4);
INSERT INTO UserGroupMember (id_group, id_user_member) VALUES (2, 5);
INSERT INTO UserGroupMember (id_group, id_user_member) VALUES (2, 6);

INSERT INTO Interest (id, name, description) VALUES (1, 'Software', 'Instructions that tell a computer what to do');
INSERT INTO Interest (id, name, description) VALUES (2, 'Hardware', 'The machines themselves as opposed to the programs which tell the machines what to do');
INSERT INTO Interest (id, name, description) VALUES (3, 'Cars', 'A road vehicle with an engine');
INSERT INTO Interest (id, name, description) VALUES (4, 'History', 'The study of past events, particularly in human affairs.');
INSERT INTO Interest (id, name, description) VALUES (5, 'Boats', 'Small vesseles for travelling over water');

INSERT INTO InterestUser (id_interest, id_user) VALUES (1, 1);
INSERT INTO InterestUser (id_interest, id_user) VALUES (2, 2);
INSERT INTO InterestUser (id_interest, id_user) VALUES (3, 3);

INSERT INTO Notification (id, id_user, read) VALUES (1, 1, FALSE);
INSERT INTO Notification (id, id_user, read) VALUES (2, 2, FALSE);
INSERT INTO Notification (id, id_user, read) VALUES (3, 3, FALSE);
INSERT INTO Notification (id, id_user, read) VALUES (4, 4, FALSE);
INSERT INTO Notification (id, id_user, read) VALUES (5, 5, FALSE);

INSERT INTO LikeNotification (id_notification, id_user, id_content) VALUES (1, 1, 1);
INSERT INTO LikeNotification (id_notification, id_user, id_content) VALUES (2, 2, 2);

INSERT INTO ReplyNotification (id_notification) VALUES (1);
INSERT INTO ReplyNotification (id_notification) VALUES (2);

INSERT INTO FriendRequestNotification (id_notification, id_friend_request) VALUES (3, 3);
INSERT INTO FriendRequestNotification (id_notification, id_friend_request) VALUES (4, 4);

INSERT INTO CommentReplyNotification (id_reply_notification, id_comment) VALUES (1, 1);

INSERT INTO TextContentReplyNotification (id_reply_notification, id_text_content) VALUES (1, 2);

INSERT INTO PaymentMethod (id, name, company, transaction_limit) VALUES (1, 'PayPal', 'PayPal', 10000);

INSERT INTO Campaign (id_media_content, id_advertiser, starting_date, finishing_date, budget, remaining_budget, impressions, clicks) VALUES (4, 6, '2021-8-23', '2021-10-23', 1200, 700, 10, 5);
INSERT INTO Campaign (id_media_content, id_advertiser, starting_date, finishing_date, budget, remaining_budget, impressions, clicks) VALUES (5, 7, '2021-4-23', '2021-7-23', 450, 200, 20, 100);

INSERT INTO GameSession (id, session_title) VALUES (1, 'Funny Game');
INSERT INTO GameSession (id, session_title) VALUES (2, 'Champions');

INSERT INTO GameStats (id_user, id_game_session, score) VALUES (1, 1, 0);
INSERT INTO GameStats (id_user, id_game_session, score) VALUES (2, 1, 10);
INSERT INTO GameStats (id_user, id_game_session, score) VALUES (3, 1, 3);
INSERT INTO GameStats (id_user, id_game_session, score) VALUES (4, 2, 5);
INSERT INTO GameStats (id_user, id_game_session, score) VALUES (5, 2, 8);
INSERT INTO GameStats (id_user, id_game_session, score) VALUES (6, 2, 7);

INSERT INTO Friends (id_user1, id_user2) VALUES (2, 1);
INSERT INTO Friends (id_user1, id_user2) VALUES (3, 1);
INSERT INTO Friends (id_user1, id_user2) VALUES (4, 2);
