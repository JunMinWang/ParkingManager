# ParkingManager

## 系統簡介
本系統為智慧化的停車場管理系統，包含停車場出入口的門禁管制，停車場管理員使用的管理軟體與行動管理App，藉由三者的交互運作，能夠為收費型停車場帶來快速、方便且具有安全性的停車場管控模式。本系統使用的技術與流程介紹如下。

## 相關技術
本系統使用到的技術介紹如下。

#### 藍牙（Bluetooth）
藍牙是一種無線技術標準，用來讓固定或行動裝置在短距離間交換資料，以形成個人區域網路（PAN）。其使用短波特高頻（UHF）無線電波，經由2.4至2.485GHz的ISM頻段來進行通訊。我們的RFID Reader係使用此標準與行動管理App進行通訊使用。

#### Wiegand
Wiegand是一種通訊協定，在雷達設備上，Wiegand使用二線式的接腳方式，利用Wiegand轉換與卡號的換算方式將16進位的數字轉換為10碼的10進位數字。Wiegand分為26與34兩種，其中的差別在於輸出的BIT(位元)數量多寡，係依照各雷達的規格而有所差異。
在Wiegand26的規範中，BIT 2~13 所有1的數目加起來必須是偶數，如果不是則將BIT1(E)設為1，使得1的個數加起來為偶數。對Wiegand 34來說，這位元就是BIT 2~17 的偶同位補位位元。對Wiegand 26而言，BIT 26是BIT 10~25 的奇數補位位元，對於Wiegand 34來說，BIT 26則是 BIT 18~33的奇數補位位元。

#### eTag
eTag是遠通電收的ETC電子標籤，因為要用於ETC，所以稱為eTag，主要用在高速公路的電子收費系統。eTag的尺寸僅有2.5cm*6.7cm，只需將eTag貼於車輛擋風玻璃上或是右方車頭燈上即可上路享受其帶來的方便性。其採用RFID（Radio Frequency IDentification）無線射頻辨識技術來進行資料的讀寫。而eTag的感應方式為被動感應，是由感應器發射無線電波，找尋一段範圍內的eTag。在被感應到後，eTag會回傳電波，並由感應器讀取eTag內存的資料。

#### 通用唯一識別碼(UUID)
UUID是軟體建構的標準之一，其目的是提供唯一的辨識資訊給分散式系統中的每個元素。使用UUID後，每個元素都可以避免與其他元素的UUID衝突。根據維基百科說明UUID的標準型式是以連字號分為五段，形式為8-4-4-4-12的32個16進位數字，不過UUID碰撞機率很低，大約比中樂透還低[11]。在使用藍牙序列埠規範(Serial Port Profile, SPP)時，手機端與藍牙設備的UUID必須是一樣的，這是一個服務的唯一標識，而且這個UUID的值必須是00001101-0000-1000-8000-00805F9B34FB。



