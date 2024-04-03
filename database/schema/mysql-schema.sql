/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `aocs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aocs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `taglist` text COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_callback_query`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_callback_query` (
  `id` bigint unsigned NOT NULL COMMENT 'Unique identifier for this query',
  `user_id` bigint DEFAULT NULL COMMENT 'Unique user identifier',
  `chat_id` bigint DEFAULT NULL COMMENT 'Unique chat identifier',
  `message_id` bigint unsigned DEFAULT NULL COMMENT 'Unique message identifier',
  `inline_message_id` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Identifier of the message sent via the bot in inline mode, that originated the query',
  `chat_instance` char(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '' COMMENT 'Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent',
  `data` char(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '' COMMENT 'Data associated with the callback button',
  `game_short_name` char(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '' COMMENT 'Short name of a Game to be returned, serves as the unique identifier for the game',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `chat_id` (`chat_id`),
  KEY `message_id` (`message_id`),
  KEY `chat_id_2` (`chat_id`,`message_id`),
  CONSTRAINT `bot_callback_query_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bot_user` (`id`),
  CONSTRAINT `bot_callback_query_ibfk_2` FOREIGN KEY (`chat_id`, `message_id`) REFERENCES `bot_message` (`chat_id`, `id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_chat` (
  `id` bigint NOT NULL COMMENT 'Unique identifier for this chat',
  `type` enum('private','group','supergroup','channel') COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Type of chat, can be either private, group, supergroup or channel',
  `title` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT '' COMMENT 'Title, for supergroups, channels and group chats',
  `username` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Username, for private chats, supergroups and channels if available',
  `first_name` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'First name of the other party in a private chat',
  `last_name` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Last name of the other party in a private chat',
  `is_forum` tinyint(1) DEFAULT '0' COMMENT 'True, if the supergroup chat is a forum (has topics enabled)',
  `all_members_are_administrators` tinyint(1) DEFAULT '0' COMMENT 'True if a all members of this group are admins',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date update',
  `old_id` bigint DEFAULT NULL COMMENT 'Unique chat identifier, this is filled when a group is converted to a supergroup',
  PRIMARY KEY (`id`),
  KEY `old_id` (`old_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_chat_join_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_chat_join_request` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
  `chat_id` bigint NOT NULL COMMENT 'Chat to which the request was sent',
  `user_id` bigint NOT NULL COMMENT 'User that sent the join request',
  `date` timestamp NOT NULL COMMENT 'Date the request was sent in Unix time',
  `bio` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Optional. Bio of the user',
  `invite_link` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Optional. Chat invite link that was used by the user to send the join request',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`),
  KEY `chat_id` (`chat_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `bot_chat_join_request_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `bot_chat` (`id`),
  CONSTRAINT `bot_chat_join_request_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `bot_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_chat_member_updated`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_chat_member_updated` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
  `chat_id` bigint NOT NULL COMMENT 'Chat the user belongs to',
  `user_id` bigint NOT NULL COMMENT 'Performer of the action, which resulted in the change',
  `date` timestamp NOT NULL COMMENT 'Date the change was done in Unix time',
  `old_chat_member` text COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Previous information about the chat member',
  `new_chat_member` text COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'New information about the chat member',
  `invite_link` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Chat invite link, which was used by the user to join the chat; for joining by invite link events only',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`),
  KEY `chat_id` (`chat_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `bot_chat_member_updated_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `bot_chat` (`id`),
  CONSTRAINT `bot_chat_member_updated_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `bot_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_chosen_inline_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_chosen_inline_result` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
  `result_id` char(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '' COMMENT 'The unique identifier for the result that was chosen',
  `user_id` bigint DEFAULT NULL COMMENT 'The user that chose the result',
  `location` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Sender location, only for bots that require user location',
  `inline_message_id` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Identifier of the sent inline message',
  `query` text COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'The query that was used to obtain the result',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `bot_chosen_inline_result_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bot_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_conversation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_conversation` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
  `user_id` bigint DEFAULT NULL COMMENT 'Unique user identifier',
  `chat_id` bigint DEFAULT NULL COMMENT 'Unique user or chat identifier',
  `status` enum('active','cancelled','stopped') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'active' COMMENT 'Conversation state',
  `command` varchar(160) COLLATE utf8mb4_unicode_520_ci DEFAULT '' COMMENT 'Default command to execute',
  `notes` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Data stored from command',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date update',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `chat_id` (`chat_id`),
  KEY `status` (`status`),
  CONSTRAINT `bot_conversation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bot_user` (`id`),
  CONSTRAINT `bot_conversation_ibfk_2` FOREIGN KEY (`chat_id`) REFERENCES `bot_chat` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_edited_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_edited_message` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
  `chat_id` bigint DEFAULT NULL COMMENT 'Unique chat identifier',
  `message_id` bigint unsigned DEFAULT NULL COMMENT 'Unique message identifier',
  `user_id` bigint DEFAULT NULL COMMENT 'Unique user identifier',
  `edit_date` timestamp NULL DEFAULT NULL COMMENT 'Date the message was edited in timestamp format',
  `text` text COLLATE utf8mb4_unicode_520_ci COMMENT 'For text messages, the actual UTF-8 text of the message max message length 4096 char utf8',
  `entities` text COLLATE utf8mb4_unicode_520_ci COMMENT 'For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text',
  `caption` text COLLATE utf8mb4_unicode_520_ci COMMENT 'For message with caption, the actual UTF-8 text of the caption',
  PRIMARY KEY (`id`),
  KEY `chat_id` (`chat_id`),
  KEY `message_id` (`message_id`),
  KEY `user_id` (`user_id`),
  KEY `chat_id_2` (`chat_id`,`message_id`),
  CONSTRAINT `bot_edited_message_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `bot_chat` (`id`),
  CONSTRAINT `bot_edited_message_ibfk_2` FOREIGN KEY (`chat_id`, `message_id`) REFERENCES `bot_message` (`chat_id`, `id`),
  CONSTRAINT `bot_edited_message_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `bot_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_inline_query`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_inline_query` (
  `id` bigint unsigned NOT NULL COMMENT 'Unique identifier for this query',
  `user_id` bigint DEFAULT NULL COMMENT 'Unique user identifier',
  `location` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Location of the user',
  `query` text COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Text of the query',
  `offset` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Offset of the result',
  `chat_type` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Optional. Type of the chat, from which the inline query was sent.',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `bot_inline_query_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bot_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_message` (
  `chat_id` bigint NOT NULL COMMENT 'Unique chat identifier',
  `sender_chat_id` bigint DEFAULT NULL COMMENT 'Sender of the message, sent on behalf of a chat',
  `id` bigint unsigned NOT NULL COMMENT 'Unique message identifier',
  `message_thread_id` bigint DEFAULT NULL COMMENT 'Unique identifier of a message thread to which the message belongs; for supergroups only',
  `user_id` bigint DEFAULT NULL COMMENT 'Unique user identifier',
  `date` timestamp NULL DEFAULT NULL COMMENT 'Date the message was sent in timestamp format',
  `forward_from` bigint DEFAULT NULL COMMENT 'Unique user identifier, sender of the original message',
  `forward_from_chat` bigint DEFAULT NULL COMMENT 'Unique chat identifier, chat the original message belongs to',
  `forward_from_message_id` bigint DEFAULT NULL COMMENT 'Unique chat identifier of the original message in the channel',
  `forward_signature` text COLLATE utf8mb4_unicode_520_ci COMMENT 'For messages forwarded from channels, signature of the post author if present',
  `forward_sender_name` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Sender''s name for messages forwarded from users who disallow adding a link to their account in forwarded messages',
  `forward_date` timestamp NULL DEFAULT NULL COMMENT 'date the original message was sent in timestamp format',
  `is_topic_message` tinyint(1) DEFAULT '0' COMMENT 'True, if the message is sent to a forum topic',
  `is_automatic_forward` tinyint(1) DEFAULT '0' COMMENT 'True, if the message is a channel post that was automatically forwarded to the connected discussion group',
  `reply_to_chat` bigint DEFAULT NULL COMMENT 'Unique chat identifier',
  `reply_to_message` bigint unsigned DEFAULT NULL COMMENT 'Message that this message is reply to',
  `via_bot` bigint DEFAULT NULL COMMENT 'Optional. Bot through which the message was sent',
  `edit_date` timestamp NULL DEFAULT NULL COMMENT 'Date the message was last edited in Unix time',
  `has_protected_content` tinyint(1) DEFAULT '0' COMMENT 'True, if the message can''t be forwarded',
  `media_group_id` text COLLATE utf8mb4_unicode_520_ci COMMENT 'The unique identifier of a media message group this message belongs to',
  `author_signature` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Signature of the post author for messages in channels',
  `text` text COLLATE utf8mb4_unicode_520_ci COMMENT 'For text messages, the actual UTF-8 text of the message max message length 4096 char utf8mb4',
  `entities` text COLLATE utf8mb4_unicode_520_ci COMMENT 'For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text',
  `caption_entities` text COLLATE utf8mb4_unicode_520_ci COMMENT 'For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption',
  `audio` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Audio object. Message is an audio file, information about the file',
  `document` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Document object. Message is a general file, information about the file',
  `animation` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Message is an animation, information about the animation',
  `game` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Game object. Message is a game, information about the game',
  `photo` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Array of PhotoSize objects. Message is a photo, available sizes of the photo',
  `sticker` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Sticker object. Message is a sticker, information about the sticker',
  `video` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Video object. Message is a video, information about the video',
  `voice` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Voice Object. Message is a Voice, information about the Voice',
  `video_note` text COLLATE utf8mb4_unicode_520_ci COMMENT 'VoiceNote Object. Message is a Video Note, information about the Video Note',
  `caption` text COLLATE utf8mb4_unicode_520_ci COMMENT 'For message with caption, the actual UTF-8 text of the caption',
  `has_media_spoiler` tinyint(1) DEFAULT '0' COMMENT 'True, if the message media is covered by a spoiler animation',
  `contact` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Contact object. Message is a shared contact, information about the contact',
  `location` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Location object. Message is a shared location, information about the location',
  `venue` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Venue object. Message is a Venue, information about the Venue',
  `poll` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Poll object. Message is a native poll, information about the poll',
  `dice` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Message is a dice with random value from 1 to 6',
  `new_chat_members` text COLLATE utf8mb4_unicode_520_ci COMMENT 'List of unique user identifiers, new member(s) were added to the group, information about them (one of these members may be the bot itself)',
  `left_chat_member` bigint DEFAULT NULL COMMENT 'Unique user identifier, a member was removed from the group, information about them (this member may be the bot itself)',
  `new_chat_title` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'A chat title was changed to this value',
  `new_chat_photo` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Array of PhotoSize objects. A chat photo was change to this value',
  `delete_chat_photo` tinyint(1) DEFAULT '0' COMMENT 'Informs that the chat photo was deleted',
  `group_chat_created` tinyint(1) DEFAULT '0' COMMENT 'Informs that the group has been created',
  `supergroup_chat_created` tinyint(1) DEFAULT '0' COMMENT 'Informs that the supergroup has been created',
  `channel_chat_created` tinyint(1) DEFAULT '0' COMMENT 'Informs that the channel chat has been created',
  `message_auto_delete_timer_changed` text COLLATE utf8mb4_unicode_520_ci COMMENT 'MessageAutoDeleteTimerChanged object. Message is a service message: auto-delete timer settings changed in the chat',
  `migrate_to_chat_id` bigint DEFAULT NULL COMMENT 'Migrate to chat identifier. The group has been migrated to a supergroup with the specified identifier',
  `migrate_from_chat_id` bigint DEFAULT NULL COMMENT 'Migrate from chat identifier. The supergroup has been migrated from a group with the specified identifier',
  `pinned_message` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Message object. Specified message was pinned',
  `invoice` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Message is an invoice for a payment, information about the invoice',
  `successful_payment` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Message is a service message about a successful payment, information about the payment',
  `user_shared` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Optional. Service message: a user was shared with the bot',
  `chat_shared` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Optional. Service message: a chat was shared with the bot',
  `connected_website` text COLLATE utf8mb4_unicode_520_ci COMMENT 'The domain name of the website on which the user has logged in.',
  `write_access_allowed` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Service message: the user allowed the bot added to the attachment menu to write messages',
  `passport_data` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Telegram Passport data',
  `proximity_alert_triggered` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Service message. A user in the chat triggered another user''s proximity alert while sharing Live Location.',
  `forum_topic_created` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Service message: forum topic created',
  `forum_topic_edited` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Service message: forum topic edited',
  `forum_topic_closed` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Service message: forum topic closed',
  `forum_topic_reopened` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Service message: forum topic reopened',
  `general_forum_topic_hidden` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Service message: the General forum topic hidden',
  `general_forum_topic_unhidden` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Service message: the General forum topic unhidden',
  `video_chat_scheduled` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Service message: video chat scheduled',
  `video_chat_started` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Service message: video chat started',
  `video_chat_ended` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Service message: video chat ended',
  `video_chat_participants_invited` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Service message: new participants invited to a video chat',
  `web_app_data` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Service message: data sent by a Web App',
  `reply_markup` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Inline keyboard attached to the message',
  PRIMARY KEY (`chat_id`,`id`),
  KEY `user_id` (`user_id`),
  KEY `forward_from` (`forward_from`),
  KEY `forward_from_chat` (`forward_from_chat`),
  KEY `reply_to_chat` (`reply_to_chat`),
  KEY `reply_to_message` (`reply_to_message`),
  KEY `via_bot` (`via_bot`),
  KEY `left_chat_member` (`left_chat_member`),
  KEY `migrate_from_chat_id` (`migrate_from_chat_id`),
  KEY `migrate_to_chat_id` (`migrate_to_chat_id`),
  KEY `reply_to_chat_2` (`reply_to_chat`,`reply_to_message`),
  CONSTRAINT `bot_message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bot_user` (`id`),
  CONSTRAINT `bot_message_ibfk_2` FOREIGN KEY (`chat_id`) REFERENCES `bot_chat` (`id`),
  CONSTRAINT `bot_message_ibfk_3` FOREIGN KEY (`forward_from`) REFERENCES `bot_user` (`id`),
  CONSTRAINT `bot_message_ibfk_4` FOREIGN KEY (`forward_from_chat`) REFERENCES `bot_chat` (`id`),
  CONSTRAINT `bot_message_ibfk_5` FOREIGN KEY (`reply_to_chat`, `reply_to_message`) REFERENCES `bot_message` (`chat_id`, `id`),
  CONSTRAINT `bot_message_ibfk_6` FOREIGN KEY (`via_bot`) REFERENCES `bot_user` (`id`),
  CONSTRAINT `bot_message_ibfk_7` FOREIGN KEY (`left_chat_member`) REFERENCES `bot_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_poll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_poll` (
  `id` bigint unsigned NOT NULL COMMENT 'Unique poll identifier',
  `question` text COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Poll question',
  `options` text COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'List of poll options',
  `total_voter_count` int unsigned DEFAULT NULL COMMENT 'Total number of users that voted in the poll',
  `is_closed` tinyint(1) DEFAULT '0' COMMENT 'True, if the poll is closed',
  `is_anonymous` tinyint(1) DEFAULT '1' COMMENT 'True, if the poll is anonymous',
  `type` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Poll type, currently can be “regular” or “quiz”',
  `allows_multiple_answers` tinyint(1) DEFAULT '0' COMMENT 'True, if the poll allows multiple answers',
  `correct_option_id` int unsigned DEFAULT NULL COMMENT '0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.',
  `explanation` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters',
  `explanation_entities` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Special entities like usernames, URLs, bot commands, etc. that appear in the explanation',
  `open_period` int unsigned DEFAULT NULL COMMENT 'Amount of time in seconds the poll will be active after creation',
  `close_date` timestamp NULL DEFAULT NULL COMMENT 'Point in time (Unix timestamp) when the poll will be automatically closed',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_poll_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_poll_answer` (
  `poll_id` bigint unsigned NOT NULL COMMENT 'Unique poll identifier',
  `user_id` bigint NOT NULL COMMENT 'The user, who changed the answer to the poll',
  `option_ids` text COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT '0-based identifiers of answer options, chosen by the user. May be empty if the user retracted their vote.',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`poll_id`,`user_id`),
  CONSTRAINT `bot_poll_answer_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `bot_poll` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_pre_checkout_query`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_pre_checkout_query` (
  `id` bigint unsigned NOT NULL COMMENT 'Unique query identifier',
  `user_id` bigint DEFAULT NULL COMMENT 'User who sent the query',
  `currency` char(3) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Three-letter ISO 4217 currency code',
  `total_amount` bigint DEFAULT NULL COMMENT 'Total price in the smallest units of the currency',
  `invoice_payload` char(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '' COMMENT 'Bot specified invoice payload',
  `shipping_option_id` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Identifier of the shipping option chosen by the user',
  `order_info` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Order info provided by the user',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `bot_pre_checkout_query_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bot_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_request_limiter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_request_limiter` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
  `chat_id` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Unique chat identifier',
  `inline_message_id` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Identifier of the sent inline message',
  `method` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Request method',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_shipping_query`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_shipping_query` (
  `id` bigint unsigned NOT NULL COMMENT 'Unique query identifier',
  `user_id` bigint DEFAULT NULL COMMENT 'User who sent the query',
  `invoice_payload` char(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '' COMMENT 'Bot specified invoice payload',
  `shipping_address` char(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '' COMMENT 'User specified shipping address',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `bot_shipping_query_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bot_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_telegram_update`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_telegram_update` (
  `id` bigint unsigned NOT NULL COMMENT 'Update''s unique identifier',
  `chat_id` bigint DEFAULT NULL COMMENT 'Unique chat identifier',
  `message_id` bigint unsigned DEFAULT NULL COMMENT 'New incoming message of any kind - text, photo, sticker, etc.',
  `edited_message_id` bigint unsigned DEFAULT NULL COMMENT 'New version of a message that is known to the bot and was edited',
  `channel_post_id` bigint unsigned DEFAULT NULL COMMENT 'New incoming channel post of any kind - text, photo, sticker, etc.',
  `edited_channel_post_id` bigint unsigned DEFAULT NULL COMMENT 'New version of a channel post that is known to the bot and was edited',
  `inline_query_id` bigint unsigned DEFAULT NULL COMMENT 'New incoming inline query',
  `chosen_inline_result_id` bigint unsigned DEFAULT NULL COMMENT 'The result of an inline query that was chosen by a user and sent to their chat partner',
  `callback_query_id` bigint unsigned DEFAULT NULL COMMENT 'New incoming callback query',
  `shipping_query_id` bigint unsigned DEFAULT NULL COMMENT 'New incoming shipping query. Only for invoices with flexible price',
  `pre_checkout_query_id` bigint unsigned DEFAULT NULL COMMENT 'New incoming pre-checkout query. Contains full information about checkout',
  `poll_id` bigint unsigned DEFAULT NULL COMMENT 'New poll state. Bots receive only updates about polls, which are sent or stopped by the bot',
  `poll_answer_poll_id` bigint unsigned DEFAULT NULL COMMENT 'A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself.',
  `my_chat_member_updated_id` bigint unsigned DEFAULT NULL COMMENT 'The bot''s chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.',
  `chat_member_updated_id` bigint unsigned DEFAULT NULL COMMENT 'A chat member''s status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates.',
  `chat_join_request_id` bigint unsigned DEFAULT NULL COMMENT 'A request to join the chat has been sent',
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`),
  KEY `chat_message_id` (`chat_id`,`message_id`),
  KEY `edited_message_id` (`edited_message_id`),
  KEY `channel_post_id` (`channel_post_id`),
  KEY `edited_channel_post_id` (`edited_channel_post_id`),
  KEY `inline_query_id` (`inline_query_id`),
  KEY `chosen_inline_result_id` (`chosen_inline_result_id`),
  KEY `callback_query_id` (`callback_query_id`),
  KEY `shipping_query_id` (`shipping_query_id`),
  KEY `pre_checkout_query_id` (`pre_checkout_query_id`),
  KEY `poll_id` (`poll_id`),
  KEY `poll_answer_poll_id` (`poll_answer_poll_id`),
  KEY `my_chat_member_updated_id` (`my_chat_member_updated_id`),
  KEY `chat_member_updated_id` (`chat_member_updated_id`),
  KEY `chat_id` (`chat_id`,`channel_post_id`),
  KEY `chat_join_request_id` (`chat_join_request_id`),
  CONSTRAINT `bot_telegram_update_ibfk_1` FOREIGN KEY (`chat_id`, `message_id`) REFERENCES `bot_message` (`chat_id`, `id`),
  CONSTRAINT `bot_telegram_update_ibfk_10` FOREIGN KEY (`poll_id`) REFERENCES `bot_poll` (`id`),
  CONSTRAINT `bot_telegram_update_ibfk_11` FOREIGN KEY (`poll_answer_poll_id`) REFERENCES `bot_poll_answer` (`poll_id`),
  CONSTRAINT `bot_telegram_update_ibfk_12` FOREIGN KEY (`my_chat_member_updated_id`) REFERENCES `bot_chat_member_updated` (`id`),
  CONSTRAINT `bot_telegram_update_ibfk_13` FOREIGN KEY (`chat_member_updated_id`) REFERENCES `bot_chat_member_updated` (`id`),
  CONSTRAINT `bot_telegram_update_ibfk_14` FOREIGN KEY (`chat_join_request_id`) REFERENCES `bot_chat_join_request` (`id`),
  CONSTRAINT `bot_telegram_update_ibfk_2` FOREIGN KEY (`edited_message_id`) REFERENCES `bot_edited_message` (`id`),
  CONSTRAINT `bot_telegram_update_ibfk_3` FOREIGN KEY (`chat_id`, `channel_post_id`) REFERENCES `bot_message` (`chat_id`, `id`),
  CONSTRAINT `bot_telegram_update_ibfk_4` FOREIGN KEY (`edited_channel_post_id`) REFERENCES `bot_edited_message` (`id`),
  CONSTRAINT `bot_telegram_update_ibfk_5` FOREIGN KEY (`inline_query_id`) REFERENCES `bot_inline_query` (`id`),
  CONSTRAINT `bot_telegram_update_ibfk_6` FOREIGN KEY (`chosen_inline_result_id`) REFERENCES `bot_chosen_inline_result` (`id`),
  CONSTRAINT `bot_telegram_update_ibfk_7` FOREIGN KEY (`callback_query_id`) REFERENCES `bot_callback_query` (`id`),
  CONSTRAINT `bot_telegram_update_ibfk_8` FOREIGN KEY (`shipping_query_id`) REFERENCES `bot_shipping_query` (`id`),
  CONSTRAINT `bot_telegram_update_ibfk_9` FOREIGN KEY (`pre_checkout_query_id`) REFERENCES `bot_pre_checkout_query` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_user` (
  `id` bigint NOT NULL COMMENT 'Unique identifier for this user or bot',
  `is_bot` tinyint(1) DEFAULT '0' COMMENT 'True, if this user is a bot',
  `first_name` char(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '' COMMENT 'User''s or bot''s first name',
  `last_name` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'User''s or bot''s last name',
  `username` char(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'User''s or bot''s username',
  `language_code` char(10) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'IETF language tag of the user''s language',
  `is_premium` tinyint(1) DEFAULT '0' COMMENT 'True, if this user is a Telegram Premium user',
  `added_to_attachment_menu` tinyint(1) DEFAULT '0' COMMENT 'True, if this user added the bot to the attachment menu',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date update',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bot_user_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bot_user_chat` (
  `user_id` bigint NOT NULL COMMENT 'Unique user identifier',
  `chat_id` bigint NOT NULL COMMENT 'Unique user or chat identifier',
  PRIMARY KEY (`user_id`,`chat_id`),
  KEY `chat_id` (`chat_id`),
  CONSTRAINT `bot_user_chat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bot_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bot_user_chat_ibfk_2` FOREIGN KEY (`chat_id`) REFERENCES `bot_chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `is_bot` tinyint NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subreg` tinyint NOT NULL,
  `language_code` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_premium` tinyint NOT NULL,
  `added_to_attachment_menu` tinyint NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'2014_10_12_100000_create_password_reset_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5,'2021_06_14_171118_create_telegram_bot_structure',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6,'2022_02_18_175100_update_to_0.75.0',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7,'2022_04_24_175700_update_to_0.77.0',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8,'2022_10_04_221900_update_to_0.78.0',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9,'2022_11_11_130500_update_to_0.80.0',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10,'2023_05-07_101600_update_to_0.81.0',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11,'2024_02_03_000180_create_aocs_table',1);
