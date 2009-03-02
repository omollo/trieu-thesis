/*
MySQL Data Transfer
Source Host: localhost
Source Database: demo2
Target Host: localhost
Target Database: demo2
Date: 3/3/2009 3:58:44 AM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for bao_duong_xe
-- ----------------------------
DROP TABLE IF EXISTS `bao_duong_xe`;
CREATE TABLE `bao_duong_xe` (
  `stt_kmbd` bigint(20) unsigned NOT NULL auto_increment,
  `so_dang_ky_xe` varchar(30) collate utf8_bin NOT NULL,
  `khoang_muc_bao_duong` varchar(200) collate utf8_bin default NULL,
  `thoi_gian` date NOT NULL,
  `speedometer` double NOT NULL,
  PRIMARY KEY  (`stt_kmbd`),
  KEY `fk_duoc_bao_duong` (`so_dang_ky_xe`),
  CONSTRAINT `fk_duoc_bao_duong` FOREIGN KEY (`so_dang_ky_xe`) REFERENCES `xe` (`so_dang_ky_xe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for bat_thuong
-- ----------------------------
DROP TABLE IF EXISTS `bat_thuong`;
CREATE TABLE `bat_thuong` (
  `stt_bt` int(10) unsigned NOT NULL auto_increment,
  `so_dang_ky_xe` varchar(30) collate utf8_bin NOT NULL,
  `loai_bat_thuong` varchar(50) collate utf8_bin default NULL,
  `mo_ta_bat_thuong` varchar(500) collate utf8_bin NOT NULL,
  `speedometer` double NOT NULL,
  PRIMARY KEY  (`stt_bt`),
  KEY `fk_co_bat_thuong` (`so_dang_ky_xe`),
  CONSTRAINT `fk_co_bat_thuong` FOREIGN KEY (`so_dang_ky_xe`) REFERENCES `xe` (`so_dang_ky_xe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for chi_nhanh
-- ----------------------------
DROP TABLE IF EXISTS `chi_nhanh`;
CREATE TABLE `chi_nhanh` (
  `ms_chi_nhanh` varchar(30) collate utf8_bin NOT NULL,
  `stt_diem` int(11) NOT NULL,
  `ten_chi_nhanh` varchar(100) collate utf8_bin NOT NULL,
  `diachi` varchar(255) collate utf8_bin NOT NULL,
  `dienthoai` varchar(30) collate utf8_bin NOT NULL,
  `loai_chi_nhanh` varchar(50) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`ms_chi_nhanh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for chuyenhang
-- ----------------------------
DROP TABLE IF EXISTS `chuyenhang`;
CREATE TABLE `chuyenhang` (
  `so_dang_ky_xe` varchar(30) collate utf8_bin NOT NULL,
  `ms_hanghoa` varchar(50) collate utf8_bin NOT NULL,
  `ngay_nhanhang` date NOT NULL,
  `diachi_nhanhang` varchar(50) collate utf8_bin NOT NULL,
  `diachi_trahang` varchar(50) collate utf8_bin NOT NULL,
  `soluong` int(11) NOT NULL default '0',
  `trang_thai` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`so_dang_ky_xe`,`ms_hanghoa`,`ngay_nhanhang`),
  KEY `fk_co_hang_hoa` (`ms_hanghoa`),
  CONSTRAINT `fk_co_chuyen_hang` FOREIGN KEY (`so_dang_ky_xe`) REFERENCES `xe` (`so_dang_ky_xe`),
  CONSTRAINT `fk_co_hang_hoa` FOREIGN KEY (`ms_hanghoa`) REFERENCES `hang_hoa` (`ms_hanghoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for gps_markers
-- ----------------------------
DROP TABLE IF EXISTS `gps_markers`;
CREATE TABLE `gps_markers` (
  `stt_diem` int(10) unsigned NOT NULL auto_increment,
  `stt_nkht` int(11) default NULL,
  `so_dang_ky_xe` varchar(30) collate utf8_bin NOT NULL,
  `ngay_khoi_hanh` date default NULL,
  `lat` double NOT NULL default '0',
  `lng` double NOT NULL default '0',
  `type` varchar(30) collate utf8_bin default NULL,
  `gps_time` bigint(20) default '0',
  PRIMARY KEY  (`stt_diem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for hang_hoa
-- ----------------------------
DROP TABLE IF EXISTS `hang_hoa`;
CREATE TABLE `hang_hoa` (
  `ms_hanghoa` varchar(50) collate utf8_bin NOT NULL,
  `stt_khachhang` int(20) NOT NULL,
  `ten_hanghoa` varchar(100) collate utf8_bin NOT NULL,
  `donvitinh` varchar(50) collate utf8_bin NOT NULL,
  `loaihang` varchar(50) collate utf8_bin default NULL,
  PRIMARY KEY  (`ms_hanghoa`),
  KEY `fk_so_huu` (`stt_khachhang`),
  CONSTRAINT `fk_so_huu` FOREIGN KEY (`stt_khachhang`) REFERENCES `khach_hang` (`stt_khachhang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for hop_dong_thue_xe
-- ----------------------------
DROP TABLE IF EXISTS `hop_dong_thue_xe`;
CREATE TABLE `hop_dong_thue_xe` (
  `so_dang_ky_xe` varchar(30) collate utf8_bin NOT NULL,
  `ms_hop_dong` varchar(100) collate utf8_bin NOT NULL,
  `stt_nhanvien` bigint(20) NOT NULL,
  `ms_chi_nhanh` varchar(30) collate utf8_bin default NULL,
  `loai_hop_dong` varchar(100) collate utf8_bin NOT NULL,
  `nguoi_tiep_nhan` varchar(100) collate utf8_bin NOT NULL,
  `km_tran` double default NULL,
  `so_tien` double default '0',
  `sothuc_te` double default '0',
  `ngay_bat_dau` date default NULL,
  `ngay_ket_thuc` date default NULL,
  `vi_tri` varchar(100) collate utf8_bin default NULL,
  `dich_vu` varchar(100) collate utf8_bin default NULL,
  `bao_hiem` text collate utf8_bin,
  `chi_phi_cho_km_them` double default '0',
  `nhuong_quyen_thuong_mai` text collate utf8_bin,
  PRIMARY KEY  (`so_dang_ky_xe`,`ms_hop_dong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for khach_hang
-- ----------------------------
DROP TABLE IF EXISTS `khach_hang`;
CREATE TABLE `khach_hang` (
  `stt_khachhang` int(20) NOT NULL auto_increment,
  `ten_khachhang` varchar(100) collate utf8_bin NOT NULL,
  `dienthoai` varchar(30) collate utf8_bin NOT NULL,
  `diachi_lienhe` varchar(100) collate utf8_bin default NULL,
  PRIMARY KEY  (`stt_khachhang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for lich_su_cap_nhat_xe
-- ----------------------------
DROP TABLE IF EXISTS `lich_su_cap_nhat_xe`;
CREATE TABLE `lich_su_cap_nhat_xe` (
  `stt_cap_nhat` bigint(20) NOT NULL auto_increment,
  `so_dang_ky_xe` varchar(30) collate utf8_bin NOT NULL,
  `ngay_cap_nhat` bigint(20) NOT NULL default '0',
  `ten` text collate utf8_bin,
  `gia_tri` text collate utf8_bin,
  PRIMARY KEY  (`stt_cap_nhat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for metadata
-- ----------------------------
DROP TABLE IF EXISTS `metadata`;
CREATE TABLE `metadata` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tablename` varchar(100) collate utf8_bin default NULL,
  `use_scaffolding` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `tablename` (`tablename`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for model_xe
-- ----------------------------
DROP TABLE IF EXISTS `model_xe`;
CREATE TABLE `model_xe` (
  `ms_model_xe` varchar(100) collate utf8_bin NOT NULL,
  `loai_model` varchar(100) collate utf8_bin default NULL,
  `nhan_hieu` varchar(100) collate utf8_bin default NULL,
  `ms_thue` varchar(100) collate utf8_bin default NULL,
  `nhienlieu` varchar(200) collate utf8_bin default NULL,
  `trongtai` double default '0',
  `dientich_san` float default '0',
  `loaixe` varchar(50) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`ms_model_xe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for nhan_vien
-- ----------------------------
DROP TABLE IF EXISTS `nhan_vien`;
CREATE TABLE `nhan_vien` (
  `stt_nhanvien` bigint(20) NOT NULL auto_increment,
  `ho_ten` varchar(100) collate utf8_bin NOT NULL,
  `tendangnhap` varchar(30) collate utf8_bin default NULL,
  `matkhau` varchar(30) collate utf8_bin default NULL,
  `nhom` smallint(6) NOT NULL default '0',
  `cong_viec` varchar(30) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`stt_nhanvien`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for nhat_ki_hanh_trinh
-- ----------------------------
DROP TABLE IF EXISTS `nhat_ki_hanh_trinh`;
CREATE TABLE `nhat_ki_hanh_trinh` (
  `stt_nkht` int(10) unsigned NOT NULL auto_increment,
  `so_dang_ky_xe` varchar(30) collate utf8_bin NOT NULL,
  `ngay_khoi_hanh` date NOT NULL,
  `ten` varchar(100) collate utf8_bin default NULL,
  `ngay_ket_thuc_dukien` date NOT NULL,
  `ngay_ket_thuc_thucte` date default NULL,
  PRIMARY KEY  (`stt_nkht`,`so_dang_ky_xe`,`ngay_khoi_hanh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for thiet_bi
-- ----------------------------
DROP TABLE IF EXISTS `thiet_bi`;
CREATE TABLE `thiet_bi` (
  `stt_thiet_bi` bigint(20) unsigned NOT NULL auto_increment,
  `so_dang_ky_xe` varchar(30) collate utf8_bin NOT NULL,
  `ten_thiet_bi` varchar(100) collate utf8_bin NOT NULL,
  `loai_thiet_bi` varchar(100) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`stt_thiet_bi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for thuoc_tinh_mo_rong_cua_xe
-- ----------------------------
DROP TABLE IF EXISTS `thuoc_tinh_mo_rong_cua_xe`;
CREATE TABLE `thuoc_tinh_mo_rong_cua_xe` (
  `so_dang_ky_xe` varchar(30) collate utf8_bin NOT NULL,
  `ten` varchar(100) collate utf8_bin NOT NULL,
  `gia_tri` text collate utf8_bin,
  PRIMARY KEY  (`so_dang_ky_xe`,`ten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for xe
-- ----------------------------
DROP TABLE IF EXISTS `xe`;
CREATE TABLE `xe` (
  `so_dang_ky_xe` varchar(30) collate utf8_bin NOT NULL,
  `ms_model_xe` varchar(100) collate utf8_bin NOT NULL,
  `the_tich_that` float NOT NULL default '0',
  `url_image` varchar(600) collate utf8_bin default NULL,
  `so_suon` varchar(50) collate utf8_bin NOT NULL,
  `speedometer` double default NULL,
  PRIMARY KEY  (`so_dang_ky_xe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `chi_nhanh` VALUES ('cn1', '1', 'chi nhanh sai gon', '123 Vo Van Tan', '84838775822', 'trung chuyển');
INSERT INTO `chi_nhanh` VALUES ('cn2', '1', 'chi nhanh sai gon', '123 Hung Vuong, quan 6', '84838775852', 'trạm điều hành');
INSERT INTO `chi_nhanh` VALUES ('cn3', '1', 'chi nhanh binh duong', 'Thi xa Thu Dau 1', '84838774233', 'trung chuyển');
INSERT INTO `hop_dong_thue_xe` VALUES ('51-K18142', '1231', '1', 'cn1', 'loại 1', 'Nguyen van A', '0', '10000000', '0', '2009-03-25', '2009-04-17', '156 Thich Quang Duc, quan Go Vap, Thanh pho Ho Chi Minh', 'cho hang', 0x62616F6869656D31, '0', 0x6B686F6E6720636F);
INSERT INTO `hop_dong_thue_xe` VALUES ('51-K18142', '1232', '2', 'cn1', 'loại 2', 'Nguyen van A', '0', '10000000', '0', '2009-03-25', '2009-04-17', '156 Thich Quang Duc, quan Go Vap, Thanh pho Ho Chi Minh', 'cho hang', 0x62616F6869656D31, '0', 0x6B686F6E6720636F);
INSERT INTO `hop_dong_thue_xe` VALUES ('51-K3775', '1236', '3', 'cn1', 'loại 3', 'Nguyen van C', '0', '10000000', '0', '2009-03-25', '2009-04-17', '156 Thich Quang Duc, quan Go Vap, Thanh pho Ho Chi Minh', 'chở bưu phẩm', 0x62616F6869656D31, '0', 0x6B686F6E6720636F);
INSERT INTO `metadata` VALUES ('154', 'bao_duong_xe', '1');
INSERT INTO `metadata` VALUES ('155', 'bat_thuong', '1');
INSERT INTO `metadata` VALUES ('156', 'chi_nhanh', '1');
INSERT INTO `metadata` VALUES ('157', 'chuyenhang', '1');
INSERT INTO `metadata` VALUES ('158', 'gps_markers', '1');
INSERT INTO `metadata` VALUES ('159', 'hang_hoa', '1');
INSERT INTO `metadata` VALUES ('160', 'hop_dong_thue_xe', '0');
INSERT INTO `metadata` VALUES ('161', 'khach_hang', '1');
INSERT INTO `metadata` VALUES ('162', 'lich_su_cap_nhat_xe', '1');
INSERT INTO `metadata` VALUES ('163', 'model_xe', '1');
INSERT INTO `metadata` VALUES ('164', 'nhan_vien', '1');
INSERT INTO `metadata` VALUES ('165', 'nhat_ki_hanh_trinh', '1');
INSERT INTO `metadata` VALUES ('166', 'thiet_bi', '1');
INSERT INTO `metadata` VALUES ('167', 'thuoc_tinh_mo_rong_cua_xe', '1');
INSERT INTO `metadata` VALUES ('168', 'xe', '0');
INSERT INTO `model_xe` VALUES ('model1', 'xe tai', 'Toyota', 'MA1111', 'dau', '20', '100', 'xe tai');
INSERT INTO `model_xe` VALUES ('model2', 'xe tai', 'Toyota', 'MA1112', 'dau deasel', '20', '20', 'xe tai');
INSERT INTO `model_xe` VALUES ('model3', 'xe tai', 'Toyota', 'MA1117', 'dau deasel', '20', '20', 'xe tai');
INSERT INTO `model_xe` VALUES ('model4', 'xe tai', 'Honda', 'MA1115', 'xang ', '10', '20', 'xe tai cho hang');
INSERT INTO `nhan_vien` VALUES ('1', 'Nguyen Van A', 'nhanvien_a', '1234', '0', 'lái xe');
INSERT INTO `nhan_vien` VALUES ('2', 'Nguyen Van B', 'nhanvien_b', '1234', '0', 'lái xe');
INSERT INTO `nhan_vien` VALUES ('3', 'Nguyen Van C', 'nhanvien_c', '1234', '0', 'lái xe');
INSERT INTO `nhan_vien` VALUES ('4', 'Nguyen Van D', 'nhanvien_d', '1234', '0', 'Quản lý');
INSERT INTO `xe` VALUES ('51-K18142', 'model1', '10', '', '18881882', '1000');
INSERT INTO `xe` VALUES ('51-K3775', 'model1', '10', '', '18881881', '1000');
INSERT INTO `xe` VALUES ('51-K3778', 'model2', '30', '', '1888111', '100');
INSERT INTO `xe` VALUES ('51-KA 8865', '4455', '10', '', '34566', '100');
