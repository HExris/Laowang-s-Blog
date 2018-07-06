-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-04-24 07:39:29
-- 服务器版本： 5.6.17-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myblog`
--

-- --------------------------------------------------------

--
-- 表的结构 `tb_article`
--

CREATE TABLE IF NOT EXISTS `tb_article` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `author` varchar(50) CHARACTER SET utf8 NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `time` date NOT NULL,
  `tag` varchar(20) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `comment_count` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `tb_article`
--

INSERT INTO `tb_article` (`id`, `title`, `author`, `username`, `time`, `tag`, `content`, `comment_count`) VALUES
(1, 'Markdown 语法说明', '华鹏', 'HExris', '2017-03-31', '帮助', '## Intro \nGo ahead, play around with the editor! Be sure to check out **bold** and *italic* styling, or even [links](https://google.com). You can type the Markdown syntax, use the toolbar, or use shortcuts like `cmd-b` or `ctrl-b`.\n\n## Lists\nUnordered lists can be started using the toolbar or by typing `* `, `- `, or `+ `. Ordered lists can be started by typing `1. `.\n\n#### Unordered\n* Lists are a piece of cake\n* They even auto continue as you type\n* A double enter will end them\n* Tabs and shift-tabs work too\n\n#### Ordered\n1. Numbered lists...\n2. ...work too!\n\n## What about images?\n![Yes](https://i.imgur.com/sZlktY7.png)\n[Markdown中文说明](https://sspai.com/post/25137)', 3),
(4, 'Markdown 语法说明', '老王', 'admin', '2017-03-31', '帮助', '## Intro\nGo ahead, play around with the editor! Be sure to check out **bold** and *italic* styling, or even [links](https://google.com). You can type the Markdown syntax, use the toolbar, or use shortcuts like `cmd-b` or `ctrl-b`.\n\n## Lists\nUnordered lists can be started using the toolbar or by typing `* `, `- `, or `+ `. Ordered lists can be started by typing `1. `.\n\n#### Unordered\n* Lists are a piece of cake\n* They even auto continue as you type\n* A double enter will end them\n* Tabs and shift-tabs work too\n\n#### Ordered\n1. Numbered lists...\n2. ...work too!\n\n## What about images?\n![Yes](https://i.imgur.com/sZlktY7.png)\n[Markdown中文说明](https://sspai.com/post/25137)', 0),
(5, 'Markdown 语法说明 ', '老王', 'admin', '2017-03-31', '帮助', '## Intro\nGo ahead, play around with the editor! Be sure to check out **bold** and *italic* styling, or even [links](https://google.com). You can type the Markdown syntax, use the toolbar, or use shortcuts like `cmd-b` or `ctrl-b`.\n\n## Lists\nUnordered lists can be started using the toolbar or by typing `* `, `- `, or `+ `. Ordered lists can be started by typing `1. `.\n\n#### Unordered\n* Lists are a piece of cake\n* They even auto continue as you type\n* A double enter will end them\n* Tabs and shift-tabs work too\n\n#### Ordered\n1. Numbered lists...\n2. ...work too!\n\n## What about images?\n![Yes](https://i.imgur.com/sZlktY7.png)\n[Markdown中文说明](https://sspai.com/post/25137)', 0),
(6, 'Markdown 语法说明', '华鹏', 'HExris', '2017-03-31', '帮助', '## Intro\nGo ahead, play around with the editor! Be sure to check out **bold** and *italic* styling, or even [links](https://google.com). You can type the Markdown syntax, use the toolbar, or use shortcuts like `cmd-b` or `ctrl-b`.\n\n## Lists\nUnordered lists can be started using the toolbar or by typing `* `, `- `, or `+ `. Ordered lists can be started by typing `1. `.\n\n#### Unordered\n* Lists are a piece of cake\n* They even auto continue as you type\n* A double enter will end them\n* Tabs and shift-tabs work too\n\n#### Ordered\n1. Numbered lists...\n2. ...work too!\n\n## What about images?\n![Yes](https://i.imgur.com/sZlktY7.png)\n[Markdown中文说明](https://sspai.com/post/25137)', 2),
(7, 'Markdown 语法说明', '华鹏', 'HExris', '2017-03-31', '帮助', '## Intro\nGo ahead, play around with the editor! Be sure to check out **bold** and *italic* styling, or even [links](https://google.com). You can type the Markdown syntax, use the toolbar, or use shortcuts like `cmd-b` or `ctrl-b`.\n\n## Lists\nUnordered lists can be started using the toolbar or by typing `* `, `- `, or `+ `. Ordered lists can be started by typing `1. `.\n\n#### Unordered\n* Lists are a piece of cake\n* They even auto continue as you type\n* A double enter will end them\n* Tabs and shift-tabs work too\n\n#### Ordered\n1. Numbered lists...\n2. ...work too!\n\n## What about images?\n![Yes](https://i.imgur.com/sZlktY7.png)\n[Markdown中文说明](https://sspai.com/post/25137)', 1),
(17, '用于演示', '傅婷', 'Futing', '2017-04-22', '', 'your documents are synchronized with **Google Drive** or **Dropbox** (check out the [<i class="icon-refresh"></i> Synchronization](#synchronization) section).\n\n#### <i class="icon-file"></i> Create a document\n\nThe document panel is accessible using the <i class="icon-folder-open"></i> button in the navigation bar. You can create a new document by clicking <i class="icon-file"></i> **New document** in the document panel.\n\n#### <i class="icon-folder-open"></i> Switch to another document\n\nAll your local documents are listed in the document panel. You can switch from one to another by clicking a document in the list or you can toggle documents using <kbd>Ctrl+[</kbd> and <kbd>Ctrl+]</kbd>.\n\n#### <i class="icon-pencil"></i> Rename a document\n\nYou can rename the current document by clicking the document title in the navigation bar.\n\n#### <i class="icon-trash"></i> Delete a document\n\nYou can delete the current document by clicking <i class="icon-trash"></i> **Delete document** in the document panel.\n\n#### <i class="icon-hdd"></i> Export a document\n\nYou can save the current document to a file by clicking <i class="icon-hdd"></i> **Export to disk** from the <i class="icon-provider-stackedit"></i> menu panel.\n\n> **Tip:** Check out the [<i class="icon-upload"></i> Publish a document](#publish-a-document) section for a description of the different output formats.\n\n\n----------\n\n\nSynchronization\n-------------------\n\nStackEdit can be combined with <i class="icon-provider-gdrive"></i> **Google Drive** and <i class="icon-provider-dropbox"></i> **Dropbox** to have your documents saved in the *Cloud*. The synchronization mechanism takes care of uploading your modifications or downloading the latest version of your documents.\n\n> **Note:**\n\n> - Full access to **Google Drive** or **Dropbox** is required to be able to import any document in StackEdit. Permission restrictions can be configured in the settings.\n> - Imported documents are downloaded in your browser and are not transmitted to a server.\n> - If you experience problems saving your documents on Google Drive, check and optionally disable browser extensions, such as Disconnect.\n\n#### <i class="icon-refresh"></i> Open a document\n\nYou can open a document from <i class="icon-provider-gdrive"></i> **Google Drive** or the <i class="icon-provider-dropbox"></i> **Dropbox** by opening the <i class="icon-refresh"></i> **Synchronize** sub-menu and by clicking **Open from...**. Once opened, any modification in your document will be automatically synchronized with the file in your **Google Drive** / **Dropbox** account.\n\n#### <i class="icon-refresh"></i> Save a document\n\nYou can save any document by opening the <i class="icon-refresh"></i> **Synchronize** sub-menu and by clicking **Save on...**. Even if your document is already synchronized with **Google Drive** or **Dropbox**, you can export it to a another location. StackEdit can synchronize one document with multiple locations and accounts.\n\n#### <i class="icon-refresh"></i> Synchronize a document\n\nOnce your document is linked to a <i class="icon-provider-gdrive"></i> **Google Drive** or a <i class="icon-provider-dropbox"></i> **Dropbox** file, StackEdit will periodically (every 3 minutes) synchronize it by downloading/uploading any modification. A merge will be performed if necessary and conflicts will be detected.\n\nIf you just have modified your document and you want to force the synchronization, click the <i class="icon-refresh"></i> button in the navigation bar.\n\n> **Note:** The <i class="icon-refresh"></i> button is disabled when you have no document to synchronize.\n\n#### <i class="icon-refresh"></i> Manage document synchronization\n\nSince one document can be synchronized with multiple locations, you can list and manage synchronized locations by clicking <i class="icon-refresh"></i> **Manage synchronization** in the <i class="icon-refresh"></i> **Synchronize** sub-menu. This will let you remove synchronization locations that are associated to your document.\n\n> **Note:** If you delete the file from **Google Drive** or from **Dropbox**, the document will no longer be synchronized with that location.\n\n----------\n\n\nPublication\n-------------\n\nOnce you are happy with your document, you can publish it on different websites directly from StackEdit. As for now, StackEdit can publish on **Blogger**, **Dropbox**, **Gist**, **GitHub**, **Google Drive**, **Tumblr**, **WordPress** and on any SSH server.\n\n#### <i class="icon-upload"></i> Publish a document\n\nYou can publish your document by opening the <i class="icon-upload"></i> **Publish** sub-menu and by choosing a website. In the dialog box, you can choose the publication format:\n\n- Markdown, to publish the Markdown text on a website that can interpret it (**GitHub** for instance),\n- HTML, to publish the document converted into HTML (on a blog for example),\n- Template, to have a full control of the output.\n\n> **Note:** The default template is a simple webpage wrapping your document in HTML format. You can customize it in the **Advanced** tab of the <i class="icon-cog"></i> **Settings** dialog.\n\n#### <i class="icon-upload"></i> Update a publication\n\nAfter publishing, StackEdit will keep your document linked to that publication which makes it easy for you to update it. Once you have modified your document and you want to update your publication, click on the <i class="icon-upload"></i> button in the navigation bar.\n\n> **Note:** The <i class="icon-upload"></i> button is disabled when your document has not been published yet.\n\n#### <i class="icon-upload"></i> Manage document publication\n\nSince one document can be published on multiple locations, you can list and manage publish locations by clicking <i class="icon-upload"></i> **Manage publication** in the <i class="icon-provider-stackedit"></i> menu panel. This will let you remove publication locations that are associated to your document.\n\n> **Note:** If the file has been removed from the website or the blog, the document will no longer be published on that location.\n\n----------\n\n\nMarkdown Extra\n--------------------\n\nStackEdit supports **Markdown Extra**, which extends **Markdown** syntax with some nice features.\n\n\n', 1),
(21, 'asdasd', '华鹏', 'HExris123', '2017-04-22', '', 'asdasdas', 0),
(22, 'asdads', '阿斯顿', 'asdasdasd', '2017-04-23', '', '# asdasdsad\n', 0),
(23, 'TEST', '傅婷', 'Futing', '2017-04-23', '', '# ASDASD\n<hr>\nasdasda\n* 2132132\n* 132132\n* 3213\n\n<hr>\n1. asdasd\n2. asdasd\n3. asdasd\n4. a\n5. s', 0),
(24, 'asdasd', '傅婷', 'Futing', '2017-04-23', '', '```\nrenderingConfig: {\n			singleLineBreaks: true,\n			codeSyntaxHighlighting: true,\n		}renderingConfig: {\n			singleLineBreaks: true,\n			codeSyntaxHighlighting: true,\n		}renderingConfig: {\n			singleLineBreaks: true,\n			codeSyntaxHighlighting: true,\n		}\n```', 0),
(25, 'asdasd', '傅婷', 'Futing', '2017-04-23', '', 'aasdasd', 0),
(26, '这是一篇文章', '管理员', 'ADMIN123', '2017-04-23', '', '# 爱上大叔大婶\n\n\n-----\n\n\n* 12132\n* 32132\n* 123\n\n\n\n-----\n> asdasda\n```\ndocument.getElementById("box");\n```\n', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tb_comment`
--

CREATE TABLE IF NOT EXISTS `tb_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(100) CHARACTER SET utf8 NOT NULL,
  `article_id` int(11) NOT NULL,
  `comment_author` varchar(100) CHARACTER SET utf8 NOT NULL,
  `time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- 转存表中的数据 `tb_comment`
--

INSERT INTO `tb_comment` (`id`, `comment`, `article_id`, `comment_author`, `time`) VALUES
(9, 'This is the first comment for test.This is the first comment for test.', 1, '华鹏', '2017-04-11'),
(12, 'This is the first comment for test.', 6, '华鹏', '2017-04-11'),
(23, '你好啊', 6, '华鹏', '0000-00-00'),
(49, 'test', 7, '华鹏', '2017-04-19'),
(50, '這是一條評論', 1, '华鹏', '2017-04-20'),
(51, 'asdasd', 1, '华鹏', '2017-04-21'),
(54, '这是一条评论', 17, '傅婷', '2017-04-23'),
(56, 'asdas', 26, '管理员', '2017-04-23');

-- --------------------------------------------------------

--
-- 表的结构 `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(20) CHARACTER SET utf8 NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(40) CHARACTER SET utf8 NOT NULL,
  `brithday` date DEFAULT NULL,
  `sex` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `qq` varchar(40) CHARACTER SET utf8 COLLATE utf8_german2_ci DEFAULT NULL,
  `ico` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `introduce` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8 NOT NULL,
  `github` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `weibo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `blog_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_german2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- 转存表中的数据 `tb_user`
--

INSERT INTO `tb_user` (`id`, `fullname`, `username`, `password`, `brithday`, `sex`, `address`, `email`, `qq`, `ico`, `introduce`, `description`, `github`, `weibo`, `blog_name`) VALUES
(1, '华鹏', 'HExris', 'hexris123', '1997-08-18', '男', '深圳市南山区科技园', 'hexris@icloud.com', '864123319', NULL, '胆小认生，不易相处', '纵有疾风起，人生不言弃', 'http://github.com/hexris', 'http://weibo.com/hexris', 'freedom'),
(10, '老王', 'admin', 'admin', '2017-04-19', NULL, NULL, NULL, NULL, NULL, '一个很懒的管理员', '请给我一张床', '', '', '老王的被窝'),
(21, '华鹏', 'HExris123', 'hexris123', '2017-03-28', '男', 'dasd', '1110@qq.com', NULL, NULL, 'asdasdasd', 'asdasdas', 'http://www.baidu.com', 'http://www.baidu.com', 'asd'),
(22, '傅婷', 'Futing', 'futing0228', '2017-04-20', '女', '', '99018112@qq.com', NULL, NULL, '我有一頭小毛驢', '鵝鵝鵝，白毛浮緑水，紅掌撥清波', '', '', 'freedom'),
(23, '傅婷', 'Jelly', 'fting960228', '1996-02-28', '女', '', '99018112@qq.com', NULL, NULL, '噓！這是秘密！', '好走的路一定是下坡路', '', '', 'Jelly'),
(28, '阿斯达斯', 'asdasdad', 'asdasasd123', '2017-04-12', '男', '', '864123319@qq.com', NULL, NULL, '这是个人介绍', '这是一句座右铭', 'http://www.baidu.com', 'http://www.baidu.com', 'HExris'),
(29, '阿斯达', 'asdasdasda', 'asdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(30, '阿斯顿', 'asdasd', 'asdasdasdsad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(31, 'das', 'asdasa', 'aaaaasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(32, '等等', 'aaaaaaaaa', 'aaaaaaa1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(33, '不错', 'sdfsd', 'asdasd1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(34, '阿斯顿', 'asdasdasd', 'asdad1', '2017-03-29', '男', '', 'fdsf@qq.caa', NULL, NULL, 'sdfsdfsdf', 'sdfsdfs', '', '', 'sdf'),
(35, '爱仕达', 'a1312', 'asdasdasda1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(36, '管理员', 'ADMIN123', 'ADMIN123', '2017-03-28', '女', '管理员', '1223@qq.ca', NULL, NULL, '管理员管理员', '管理员', '', '', '管理员'),
(37, '所发生的', 'sdfsf', 'asdsadasd1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
