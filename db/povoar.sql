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

INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (2, 'Prabovers', 'David N. Thomas', 'user@example.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '561-883-6567', 12, '1988-2-13'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (3, 'Rivinquister', 'Robert A. West', 'RobertAWest@armyspy.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '616-261-7167', 2, '1962-10-20'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (4, 'Hoppled91', 'Isaac K. Spencer', 'IsaacKSpencer@dayrep.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '914-964-9238', 2, '1991-8-6'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (5, 'Ingled91', 'Tim K. Gutierrez', 'TimKGutierrez@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '270-379-5170', 3, '1991-10-28'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (6, 'Daimpas1985', 'William T. Hancock', 'WilliamTHancock@jourrapide.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '504-491-4903', 3, '1985-7-13'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (7, 'Forneved', 'Paul J. Gillen', 'PaulJGillen@jourrapide.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '203-509-4665', 4, '1947-10-27'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (8, 'Stoonce', 'Clarence S. Catron', 'ClarenceSCatron@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '406-775-1564', 4, '1995-4-20'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (9, 'Walcon', 'Susanne M. Miller', 'SusanneMMiller@dayrep.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '631-444-4388', 5, '1986-11-29'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (10, 'Museltole', 'John K. Shuman', 'JohnKShuman@jourrapide.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '919-484-3756', 5, '1983-9-22'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (11, 'Hatecrable2000', 'Jeniffer J. Parsons', 'JenifferJParsons@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '814-845-9721', 6, '2000-3-1'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (12, 'Dights1956', 'Kim B. McClain', 'KimBMcClain@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '702-243-7350', 6, '1956-12-17'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (13, 'Examated', 'Casey J. Russo', 'CaseyJRusso@jourrapide.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '314-765-9362', 7, '1996-8-24'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (14, 'Thenly', 'Ines C. Yancey', 'InesCYancey@jourrapide.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '203-736-5651', 7, '1992-4-27'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (15, 'Caus1973', 'Patricia E. Horton', 'PatriciaEHorton@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '336-750-8290', 8, '1973-7-23'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (16, 'Lighbothe', 'Cathy F. McBride', 'CathyFMcBride@jourrapide.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '801-667-2817', 8, '1958-8-15'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (17, 'Hatumer', 'Betty R. Seamon', 'BettyRSeamon@rhyta.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '302-570-5766', 9, '1985-11-8'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (18, 'Buls1950', 'Silvia P. Broadhurst', 'SilviaPBroadhurst@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '781-727-1458', 9, '1950-2-21'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (19, 'Ourne2001', 'Scott K. Goode', 'ScottKGoode@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '352-431-8723', 10, '2001-4-13'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (20, 'Miltary58', 'Carmela H. Choi', 'CarmelaHChoi@teleworm.us', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '360-697-3591', 11, '1958-6-2'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (21, 'Evernshould', 'Evelyn M. Dudley', 'EvelynMDudley@rhyta.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', NULL, NULL, '561-265-2290', 12, '1956-3-4'); --1234
INSERT INTO users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (22, 'admin', 'SU Admin', 'admin@socialup.com', '$2y$10$EOAidWrMdRctCQLsICSVXuLvTEquByvzlAMbd31Vm7io4r3O5xJy6', NULL, NULL, '931234567', 11, '1990-5-7'); --admin
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

INSERT INTO groups (id, name, description) VALUES (1, 'Game Development', 'Who doens t like games? Join Us');
INSERT INTO groups (id, name, description) VALUES (2, 'Motards', 'We love bikes more than ourselves!');
INSERT INTO groups (id, name, description) VALUES (3, 'Basketball', 'Kobe!!!!!');
SELECT setval('groups_id_seq', (SELECT max(id) FROM groups));

INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (1, '2021-5-23', NULL, 1);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (2, '2015-7-28', 2, 2);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (3, '2020-4-3', NULL, 3);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (4, '2021-10-12', 1, 4);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (5, '2019-1-10', NULL, 5);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (6, '2018-9-20', NULL, 6);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (7, '2021-5-7', NULL, 7);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (8, '2020-2-16', 1, 8);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (9, '2021-6-29', NULL, 9);
INSERT INTO content (id, publishing_date, id_group, id_creator) VALUES (10, '2020-1-3', NULL, 10);
SELECT setval('content_id_seq', (SELECT max(id) FROM content));

INSERT INTO content_like (date, id_user, id_content) VALUES ('2021-5-23', 1, 1);
INSERT INTO content_like (date, id_user, id_content) VALUES ('2015-7-28', 2, 2);
INSERT INTO content_like (date, id_user, id_content) VALUES ('2020-4-3', 3, 3);
INSERT INTO content_like (date, id_user, id_content) VALUES ('2021-10-12', 4, 4);
INSERT INTO content_like (date, id_user, id_content) VALUES ('2019-1-10', 5, 5);
INSERT INTO content_like (date, id_user, id_content) VALUES ('2018-9-20', 6, 6);
INSERT INTO content_like (date, id_user, id_content) VALUES ('2021-5-7', 7, 7);
INSERT INTO content_like (date, id_user, id_content) VALUES ('2020-2-16', 8, 8);
INSERT INTO content_like (date, id_user, id_content) VALUES ('2021-6-29', 9, 9);
INSERT INTO content_like (date, id_user, id_content) VALUES ('2020-1-3', 10, 10);

INSERT INTO text_content (id_content, post_text) VALUES (1, 'Today i made a funny thing!');
INSERT INTO text_content (id_content, post_text) VALUES (2, 'I love to write SQL');
INSERT INTO text_content (id_content, post_text) VALUES (3, 'LBAW is the best course in the world');
INSERT INTO text_content (id_content, post_text) VALUES (4, 'Who is the best football player?');
INSERT INTO text_content (id_content, post_text) VALUES (5, 'Take it easy, keep calm');

INSERT INTO text_reply (child_text, parent_text) VALUES (1, 2);
INSERT INTO text_reply (child_text, parent_text) VALUES (4, 3);

INSERT INTO media_content (id_content, description, media, alt_text, fullscreen, id_locale) VALUES (6, 'Just a cute video', '/cute.png', 'Photo of a cat playing', TRUE, 6);
INSERT INTO media_content (id_content, description, media, alt_text, fullscreen, id_locale) VALUES (7, 'BMW', '/moto.jpeg', NULL, FALSE, 7);
INSERT INTO media_content (id_content, description, media, alt_text, fullscreen, id_locale) VALUES (8, 'Mercedes car', '/car.png', 'Picture of a Mercedes car', TRUE, 8);
INSERT INTO media_content (id_content, description, media, alt_text, fullscreen, id_locale) VALUES (9, 'Learn SQL for beginners', '/tutorial.mp4', 'Video tutorial', FALSE, 9);
INSERT INTO media_content (id_content, description, media, alt_text, fullscreen, id_locale) VALUES (10, 'Gameplay of Fortnite. ;)', '/game.mp4', NULL, FALSE, 10);

INSERT INTO image (id_media_content, width, height) VALUES (6, 200, 100);
INSERT INTO image (id_media_content, width, height) VALUES (7, 300, 400);
INSERT INTO image (id_media_content, width, height) VALUES (8, 500, 100);

INSERT INTO video (id_media_content, title, views) VALUES (9, 'SQL Tutorial 2021', 100);
INSERT INTO video (id_media_content, title, views) VALUES (10, 'Game', 300);

INSERT INTO comment (id, comment_text, comment_date, author, id_media_content) VALUES (1, 'So cute!', '2021-10-11', 1, 6);
INSERT INTO comment (id, comment_text, comment_date, author, id_media_content) VALUES (2, 'Very good brand', '2021-10-12', 2, 7);
INSERT INTO comment (id, comment_text, comment_date, author, id_media_content) VALUES (3, 'I do not like that car', '2021-10-13', 3, 8);
INSERT INTO comment (id, comment_text, comment_date, author, id_media_content) VALUES (4, 'Great tutorial', '2021-10-14', 4, 9);
INSERT INTO comment (id, comment_text, comment_date, author, id_media_content) VALUES (5, 'I play this game all the time', '2021-10-15', 5, 10);
INSERT INTO comment (id, comment_text, comment_date, author, id_media_content) VALUES (6, 'Best Dev Interview I have seen!', '2020-05-22', 5, 10);
SELECT setval('comment_id_seq', (SELECT max(id) FROM comment));

INSERT INTO friend_request (id, creation_date, id_sender, id_receiver) VALUES (1, '2020-7-23', 1, 2);
INSERT INTO friend_request (id, creation_date, id_sender, id_receiver) VALUES (2, '2021-3-2', 1, 3);
INSERT INTO friend_request (id, creation_date, id_sender, id_receiver) VALUES (3, '2021-10-11', 3, 4);
INSERT INTO friend_request (id, creation_date, id_sender, id_receiver) VALUES (4, '2020-9-8', 4, 5);
INSERT INTO friend_request (id, creation_date, id_sender, id_receiver) VALUES (5, '2021-6-11', 6, 7);
INSERT INTO friend_request (id, creation_date, id_sender, id_receiver) VALUES (6, '2021-12-31', 10, 11);
SELECT setval('friend_request_id_seq', (SELECT max(id) FROM friend_request));

INSERT INTO accepted_friend_request (id_friend_request, accepted_date) VALUES (1, '2021-7-24');
INSERT INTO accepted_friend_request (id_friend_request, accepted_date) VALUES (2, '2021-7-23');
INSERT INTO accepted_friend_request (id_friend_request, accepted_date) VALUES (3, '2021-11-23');

INSERT INTO rejected_friend_request (id_friend_request, rejected_date) VALUES (4, '2021-10-23');
INSERT INTO rejected_friend_request (id_friend_request, rejected_date) VALUES (5, '2021-7-23');

INSERT INTO message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (1, 'Hello', 1, 2, '2021-10-15');
INSERT INTO message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (2, 'Hi', 2, 3, '2021-10-23');
INSERT INTO message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (3, 'Can I ask you something?', 3, 4, '2021-10-27');
INSERT INTO message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (4, 'Hey there!', 4, 5, '2021-10-3');
INSERT INTO message (id, text, id_user_sender, id_user_receiver, msg_date) VALUES (5, 'I would like to meet you!', 5, 6, '2021-10-1');
SELECT setval('message_id_seq', (SELECT max(id) FROM message));

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

INSERT INTO user_interest (id_interest, id_user) VALUES (1, 1);
INSERT INTO user_interest (id_interest, id_user) VALUES (2, 2);
INSERT INTO user_interest (id_interest, id_user) VALUES (3, 3);

INSERT INTO notification (id, id_user, read) VALUES (1, 1, FALSE);
INSERT INTO notification (id, id_user, read) VALUES (2, 2, FALSE);
INSERT INTO notification (id, id_user, read) VALUES (3, 3, FALSE);
INSERT INTO notification (id, id_user, read) VALUES (4, 4, FALSE);
INSERT INTO notification (id, id_user, read) VALUES (5, 5, FALSE);
SELECT setval('notification_id_seq', (SELECT max(id) FROM notification));

INSERT INTO like_notification (id_notification, id_user, id_content) VALUES (1, 1, 1);
INSERT INTO like_notification (id_notification, id_user, id_content) VALUES (2, 2, 2);

INSERT INTO reply_notification (id_notification) VALUES (1);
INSERT INTO reply_notification (id_notification) VALUES (2);

INSERT INTO friend_request_notification (id_notification, id_friend_request) VALUES (3, 3);
INSERT INTO friend_request_notification (id_notification, id_friend_request) VALUES (4, 4);

INSERT INTO comment_reply_notification (id_reply_notification, id_comment) VALUES (1, 1);

INSERT INTO text_content_reply_notification (id_reply_notification, id_text_content) VALUES (1, 2);

INSERT INTO payment_method (id, name, company, transaction_limit) VALUES (1, 'PayPal', 'PayPal', 10000);
SELECT setval('payment_method_id_seq', (SELECT max(id) FROM payment_method));

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

INSERT INTO friends (id_user1, id_user2) VALUES (2, 1);
INSERT INTO friends (id_user1, id_user2) VALUES (3, 1);
INSERT INTO friends (id_user1, id_user2) VALUES (4, 2);
