USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_TampilDataMutasiDetail]    Script Date: 02/15/2024 10:28:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_TampilDataMutasiDetail]
@SoTransacID char(15)
AS
BEGIN
IF EXISTS(SELECT [Table_name] FROM tempdb.information_schema.tables WHERE [Table_name] like '#temptess') 
    BEGIN
      DROP TABLE #temptess;
 END;

create table #temptess(
    Itemno float,
    PartId char(10),
    PartName char(60),
    prodclass char(10),
    subprod char(10),
    product char(10),
    Quantity float,
    keterangan varchar(255),
    Refno varchar(50),
    batchno varchar(50),
    warehouse varchar(50),
    warehouse2 varchar(50),
    transtype varchar(50)
)
BEGIN
INSERT INTO #temptess
SELECT Itemno,PartId,PartName,prodclass,subprod,product,Quantity,keterangan,Refno,batchno,warehouse,warehouse2,transtype FROM  mutasidetail2 where SOTransacID=@SoTransacID			
END;
SELECT * FROM #temptess order by Itemno ASC
END;
