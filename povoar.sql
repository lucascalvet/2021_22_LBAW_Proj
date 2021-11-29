--SET Search.path lbaw2121;

--PRAGMA foreign_keys=ON;

--INSERT INTO User values(luke01, Skywalker, lukinhas@myself.com, (password123); Qione78BbshSH, /img/feltcute.png, /img/ElonMusk, 913568142, strftime('%s', '2020-09-23'););;

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
--CommentReplyNotification: 0

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

INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (1, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (2, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (3, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (4, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (5, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (6, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (7, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (8, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (9, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (10, '', '', '', '', '', '', '');

INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (11, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (12, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (13, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (14, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (15, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (16, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (17, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (18, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (19, '', '', '', '', '', '', '');
INSERT INTO Users (id, username, name, email, hashed_password, profile_picture, cover_picture, phone_number, id_country, birthday) VALUES (20, '', '', '', '', '', '', '');

INSERT INTO AdminUser (id_user) VALUES ();

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

INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES ();
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES ();
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES ();
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES ();
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES ();
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES ();
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES ();
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES ();
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES ();
INSERT INTO Advertiser (id_user, company_name, id_wallet) VALUES ();

INSERT INTO Groups (id, name, description) VALUES (1, '', '');
INSERT INTO Groups (id, name, description) VALUES (2, '', '');

INSERT INTO Content (id, publish_date, id_group, id_creator) VALUES ();
INSERT INTO Content (id, publish_date, id_group, id_creator) VALUES ();
INSERT INTO Content (id, publish_date, id_group, id_creator) VALUES ();
INSERT INTO Content (id, publish_date, id_group, id_creator) VALUES ();
INSERT INTO Content (id, publish_date, id_group, id_creator) VALUES ();
INSERT INTO Content (id, publish_date, id_group, id_creator) VALUES ();
INSERT INTO Content (id, publish_date, id_group, id_creator) VALUES ();
INSERT INTO Content (id, publish_date, id_group, id_creator) VALUES ();
INSERT INTO Content (id, publish_date, id_group, id_creator) VALUES ();
INSERT INTO Content (id, publish_date, id_group, id_creator) VALUES ();

INSERT INTO ContentLike (date, id_user, id_content) VALUES ();
INSERT INTO ContentLike (date, id_user, id_content) VALUES ();
INSERT INTO ContentLike (date, id_user, id_content) VALUES ();
INSERT INTO ContentLike (date, id_user, id_content) VALUES ();
INSERT INTO ContentLike (date, id_user, id_content) VALUES ();
INSERT INTO ContentLike (date, id_user, id_content) VALUES ();
INSERT INTO ContentLike (date, id_user, id_content) VALUES ();
INSERT INTO ContentLike (date, id_user, id_content) VALUES ();
INSERT INTO ContentLike (date, id_user, id_content) VALUES ();
INSERT INTO ContentLike (date, id_user, id_content) VALUES ();

INSERT INTO TextContent (id, post_text, id_content) VALUES (1, );
INSERT INTO TextContent (id, post_text, id_content) VALUES (2, );
INSERT INTO TextContent (id, post_text, id_content) VALUES (3, );
INSERT INTO TextContent (id, post_text, id_content) VALUES (4, );
INSERT INTO TextContent (id, post_text, id_content) VALUES (5, );

INSERT INTO TextReply (child_text, parent_text) VALUES ();
INSERT INTO TextReply (child_text, parent_text) VALUES ();

INSERT INTO MediaContent (id, description, media, fullscreen, id_content, id_locale) VALUES ();
INSERT INTO MediaContent (id, description, media, fullscreen, id_content, id_locale) VALUES ();
INSERT INTO MediaContent (id, description, media, fullscreen, id_content, id_locale) VALUES ();
INSERT INTO MediaContent (id, description, media, fullscreen, id_content, id_locale) VALUES ();
INSERT INTO MediaContent (id, description, media, fullscreen, id_content, id_locale) VALUES ();

INSERT INTO Image (id, alt_text, width, height, id_media_content) VALUES ();
INSERT INTO Image (id, alt_text, width, height, id_media_content) VALUES ();
INSERT INTO Image (id, alt_text, width, height, id_media_content) VALUES ();

INSERT INTO Video (id, alt_text, views, id_media_content) VALUES ();
INSERT INTO Video (id, alt_text, views, id_media_content) VALUES ();

INSERT INTO Comment (id, comment_text, comment_date, author, id_media_content) VALUES ();
INSERT INTO Comment (id, comment_text, comment_date, author, id_media_content) VALUES ();
INSERT INTO Comment (id, comment_text, comment_date, author, id_media_content) VALUES ();
INSERT INTO Comment (id, comment_text, comment_date, author, id_media_content) VALUES ();
INSERT INTO Comment (id, comment_text, comment_date, author, id_media_content) VALUES ();

INSERT INTO FriendRequest (id, creation, id_sender, id_receiver) VALUES ();
INSERT INTO FriendRequest (id, creation, id_sender, id_receiver) VALUES ();
INSERT INTO FriendRequest (id, creation, id_sender, id_receiver) VALUES ();
INSERT INTO FriendRequest (id, creation, id_sender, id_receiver) VALUES ();
INSERT INTO FriendRequest (id, creation, id_sender, id_receiver) VALUES ();

INSERT INTO AcceptedFriendRequest (id_friend_request, accepted_date) VALUES ();
INSERT INTO AcceptedFriendRequest (id_friend_request, accepted_date) VALUES ();
INSERT INTO AcceptedFriendRequest (id_friend_request, accepted_date) VALUES ();

INSERT INTO RejectedFriendRequest (id_friend_request, rejected_date) VALUES ();
INSERT INTO RejectedFriendRequest (id_friend_request, rejected_date) VALUES ();

INSERT INTO Message (id, message, id_user_sender, id_user_receiver, publish_date) VALUES ();
INSERT INTO Message (id, message, id_user_sender, id_user_receiver, publish_date) VALUES ();
INSERT INTO Message (id, message, id_user_sender, id_user_receiver, publish_date) VALUES ();
INSERT INTO Message (id, message, id_user_sender, id_user_receiver, publish_date) VALUES ();
INSERT INTO Message (id, message, id_user_sender, id_user_receiver, publish_date) VALUES ();

INSERT INTO UserGroupModerator (id_group, id_user_moderator) VALUES ();

INSERT INTO UserGroupMember (id_group, id_user_member) VALUES ();
INSERT INTO UserGroupMember (id_group, id_user_member) VALUES ();
INSERT INTO UserGroupMember (id_group, id_user_member) VALUES ();
INSERT INTO UserGroupMember (id_group, id_user_member) VALUES ();
INSERT INTO UserGroupMember (id_group, id_user_member) VALUES ();

INSERT INTO Interest (id, name, description) VALUES ();
INSERT INTO Interest (id, name, description) VALUES ();
INSERT INTO Interest (id, name, description) VALUES ();
INSERT INTO Interest (id, name, description) VALUES ();
INSERT INTO Interest (id, name, description) VALUES ();

INSERT INTO InterestUser (id_interest, id_user) VALUES ();
INSERT INTO InterestUser (id_interest, id_user) VALUES ();
INSERT INTO InterestUser (id_interest, id_user) VALUES ();

INSERT INTO Notification () VALUES ();
INSERT INTO Notification () VALUES ();
INSERT INTO Notification () VALUES ();
INSERT INTO Notification () VALUES ();
INSERT INTO Notification () VALUES ();

INSERT INTO LikeNotification () VALUES ();
INSERT INTO LikeNotification () VALUES ();

INSERT INTO ReplyNotification () VALUES ();
INSERT INTO ReplyNotification () VALUES ();

INSERT INTO FriendRequestNotification () VALUES ();
INSERT INTO FriendRequestNotification () VALUES ();
