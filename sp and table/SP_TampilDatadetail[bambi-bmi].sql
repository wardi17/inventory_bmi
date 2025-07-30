USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_TampilDataMutasi]    Script Date: 02/01/2024 10:16:53 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_TampilDatadetail]
@SoTransacID char(15)
AS

BEGIN
IF EXISTS(SELECT [Table_name] FROM tempdb.information_schema.tables WHERE [Table_name] like '#temptess') 
    BEGIN
      DROP TABLE #temptess;
 END;

create table #temptess(
    PartId char(10),
    PartName char(60),
    warehouse varchar(50),
    Quantity float
)

BEGIN
     DECLARE @PartId char(10);
     DECLARE @partname varchar(60);
     DECLARE @warehouse varchar(50);
     DECLARE @Quantity float;
     
END

BEGIN
 SET  @PartId =(SELECT top 1 PartId from mutasidetail2 where SOTransacID=@SoTransacID ORDER BY Itemno DESC);
 SET  @partname =(SELECT top 1 PartName from mutasidetail2 where SOTransacID=@SoTransacID ORDER BY Itemno DESC);
 SET  @warehouse =(SELECT top 1 warehouse from mutasidetail2 where SOTransacID=@SoTransacID ORDER BY Itemno DESC);
 SET  @Quantity =(SELECT SUM(Quantity) from mutasidetail2 where SOTransacID=@SoTransacID);
END


BEGIN
	 INSERT INTO #temptess(PartId,PartName,warehouse,Quantity)
	 VALUES(@PartId,@partname,@warehouse,@Quantity)		
END;
SELECT * FROM #temptess
END;
GO
--EXEC SP_TampilDatadetail 'FG240131164249'


