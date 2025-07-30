USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_TampilListDataMutasi]    Script Date: 02/19/2024 14:54:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_TampilListDataMutasi]
@userid varchar(100),
@tahun varchar(4),
@akseposting char(1)
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
	where YEAR(Shipdate) =@tahun AND flagsave is NULL AND flagtransfer is NULL	
	END;
ELSE
	BEGIN
	INSERT INTO #temptess
	SELECT SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
	where UserIDEntry=@userid AND YEAR(Shipdate) =@tahun AND flagsave is NULL AND flagtransfer is NULL	
	END;

SELECT * FROM #temptess
END;

--go
--EXEC SP_TampilListDataMutasi 'asian','2024' , 'Y'