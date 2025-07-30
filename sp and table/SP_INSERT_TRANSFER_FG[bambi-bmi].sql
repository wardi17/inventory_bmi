USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_INSERT_TRANSFER_FG]    Script Date: 02/15/2024 10:19:03 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_INSERT_TRANSFER_FG]
@transno char(15),
@partid varchar(50),
@transtype varchar(150),
@refno varchar(150),
@batchno varchar(50),
@pcs int,
@comment text,
@warehouse varchar(50),
@warehouse2 varchar(50)
AS
BEGIN
    
     DECLARE @ItemNoset float;
     DECLARE @partname varchar(60);
     DECLARE @prodclass varchar(10);
     DECLARE @product varchar(10);
     DECLARE @subprod varchar(10);
END
BEGIN
 SET  @ItemNoset =(SELECT COALESCE((select top 1 Itemno from [bambi-bmi].[dbo].mutasidetail2 where SOTransacID=@transno ORDER BY Itemno DESC), 0));
 SET @partname = (SELECT partname FROM  partmaster WHERE partid=@partid);
 SET @prodclass = (SELECT prodclass FROM  partmaster WHERE partid=@partid);
 SET @product = (SELECT product FROM  partmaster WHERE partid=@partid);
 SET @subprod = (SELECT subprod FROM  partmaster WHERE partid=@partid);
END




BEGIN
INSERT  INTO mutasidetail2(SoTransacID,Itemno,PartId,PartName,
		transtype,refno,batchno,Quantity,keterangan,warehouse,warehouse2,prodclass,product,subprod)
		VALUES(@transno,(@ItemNoset+1),@partid,@partname,
		@transtype,@refno,@batchno,@pcs,@comment,@warehouse,@warehouse2,@prodclass,@product,@subprod)
END

--SELECT * FROM mutasidetail2

