USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_TampilListTransferMutasi]    Script Date: 02/19/2024 16:12:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_TampilListTransferMutasi]
@userid varchar(100),
@tahun varchar(4),
@akseposting char(2)
AS
BEGIN
IF EXISTS(SELECT [Table_name] FROM tempdb.information_schema.tables WHERE [Table_name] like '#temptess') 
    BEGIN
      DROP TABLE #temptess;
 END;

create table #temptess(
	SoTransacID char(15),
	Shipdate datetime,
	SOEntryDesc varchar(255),
	UserId char(10)
	
)



IF(@akseposting ='Y')
	BEGIN
	INSERT INTO #temptess
	SELECT SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
	where  YEAR(Shipdate) =@tahun AND flagsave is NULL AND flagtransfer='TF'	
	END;
ELSE
	BEGIN
	INSERT INTO #temptess
	SELECT SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
	where UserIDEntry=@userid AND YEAR(Shipdate) =@tahun AND flagsave is NULL AND flagtransfer='TF'	
	END;
SELECT * FROM #temptess
END;


--GO
--EXEC SP_TampilListTransferMutasi'wardi','2024','Y'