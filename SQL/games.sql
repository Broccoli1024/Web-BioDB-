drop database if exists games; #先にgamesと言う名前のデータベースがあったら削除する
create database games; #gamesという名前のデータベースを作成する

use games; #gamesデータベースを使用する

#テーブルを作成する
create table GAME(gameID int not null auto_increment,
                  releasedate char(10) not null,     #date型という日付用の型。YYYY-MM-DD
				  tytle char(60) not null,
				  maker char(40) not null,
				  CERO char(3) not null,
                  img char(100) not null,
                  url text,                    #長い文字列用にtext型(65535文字)がある。管理上・性能上の理由で多用は控えるべき。
		 		primary key(gameID));           #主キー(primary key)の設定

create table Company(maker char(40) not null,
                     establish int(4) not null,
                     area char(10) not null,
                     url text,
                     primary key(maker));

insert into GAME values
('1',	'6月6日',	'東方スペルカーニバル',	'コンパイルハート',	'A',	'東方スペルカーニバル.jpg',	'https://store-jp.nintendo.com/list/software/70010000071393.html'),
('2',	'6月6日',	'セヴンデイズ あなたとすごす七日間',	'プロトタイプ',	'D',	'セブンデイズ.jpg',	'https://store-jp.nintendo.com/list/software/70010000077862.html'),
('3',	'6月13日',	'コンストラクション シミュレーター 4',	'3goo',	'B',	'コンストラクション4.jpg',	'https://store-jp.nintendo.com/list/software/70010000078351.html'),
('4',	'6月14日',	'真・女神転生V Vengeance',	'アトラス',	'C',	'真・女神転生V.jpg',	'https://store-jp.nintendo.com/list/software/70010000063738.html'),
('5',	'6月14日',	'モンスターハンター ストーリーズ',	'カプコン',	'A',	'モンスターハンターストーリーズ.jpg',	'https://store-jp.nintendo.com/list/software/70010000066339.html'),
('6',	'6月20日',	'ラスティッド・モス',	'PLAYISM',	'C',	'ラスティッド・モス.jpg',	'https://store-jp.nintendo.com/list/software/70010000067935.html'),
('7',	'6月20日',	'緋色の欠片 玉依姫奇譚 〜おもいいろの記憶〜 for Nintendo Switch',	'アイディアファクトリー',	'B',	'abc.jpg',	'https://www.otomate.jp/hiiro/switch/'),
('8',	'6月20日',	'心霊ホラーADVシリーズ全集 死印×NG×死噛',	'エクスペリエンス',	'Z',	'心霊ホラー全集.jpg',	'https://horror-game.jp/horror-all/'),
('9',	'6月20日',	'無職転生 〜異世界行ったら本気だす〜 Quest of Memories',	'ブシロードゲームズ',	'B',	'無職転生.jpg',	'https://store-jp.nintendo.com/list/software/70010000063383.html'),
('10',	'6月25日',	'スーパーモンキーボール バナナランブル',	'セガ',	'A',	'スーパーモンキーボール.jpg',	'https://store-jp.nintendo.com/list/software/70010000057431.html'),
('11',	'6月27日',	'のらねこものがたり ねこねこEdition',	'CFK',	'B',	'のらねこものがたり.jpg',	'https://store-jp.nintendo.com/list/software/70010000027709.html'),
('12',	'6月27日',	'岩倉アリア',	'MAGES.',	'C',	'岩倉アリア.jpg',	'https://store-jp.nintendo.com/list/software/70010000075606.html'),
('13',	'6月27日',	'アルカナ・アルケミア',	'エンターグラム',	'D',	'アルカナ・アルケミア.jpg',	'https://store-jp.nintendo.com/list/software/70010000076432.html'),
('14',	'6月27日',	'爆走次元ネプテューヌ VS巨神スライヌ',	'コンパイルハート',	'C',	'ネプテューヌ.jpg',	'https://store-jp.nintendo.com/list/software/70010000075382.html'),
('15',	'6月27日',	'planetarian 〜ちいさなほしのゆめ&雪圏球〜',	'プロトタイプ',	'A',	'planetarian.jpg',	'https://store-jp.nintendo.com/list/software/70010000080980.html'),
('16',	'6月27日',	'RIZAP for Nintendo Switch 〜体感♪リズムトレーニング〜',	'ポケット',	'A',	'RIZAP.jpg',	'https://store-jp.nintendo.com/list/software/70010000080277.html'),
('17',	'6月27日',	'ルイージマンション2 HD',	'任天堂',	'A',	'ルイージマンション２ HD.jpg',	'https://store-jp.nintendo.com/list/software/70010000072953.html');

insert into Company values
('コンパイルハート',	'2006',	'東京',	'https://www.compileheart.com'),
('プロトタイプ',	'2006',	'東京',	'https://www.prot.co.jp'),
('3goo',	'2009',	'東京',	'https://3goo.co.jp'),
('アトラス',	'1986',	'東京',	'https://www.atlus.co.jp'),
('カプコン',	'1979',	'大阪',	'https://www.capcom.co.jp'),
('PLAYISM',	'2008',	'大阪',	'https://playism.com'),
('アイディアファクトリー',	'1994',	'東京',	'https://www.ideaf.co.jp'),
('エクスペリエンス',	'2007',	'東京',	'https://experience.co.jp'),
('ブシロードゲームズ',	'2007',	'東京',	'https://bushiroadgames.com'),
('セガ',	'1960',	'東京',	'https://www.sega.jp'),
('CFK',	'1998',	'東京',	'https://cfk.kr/Main/index?lang=jp'),
('MAGES.',	'2006',	'東京',	'https://mages.co.jp'),
('エンターグラム',	'1999',	'大阪',	'https://www.entergram.co.jp'),
('ポケット',	'2016',	'東京',	'https://www.pckt.co.jp/index.html'),
('任天堂',	'1947',	'京都',	'https://www.nintendo.com/jp/index.html');