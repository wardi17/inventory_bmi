USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_TampilListMutasiPosting]    Script Date: 02/19/2024 15:22:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_TampilListMutasiPostingRAD]
@userid varchar(100),
@tahun varchar(4),
@flagtf char(10),
@akseposting char(1),
@filter VARCHAR(150)
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
	
DECLARE @cekdate  INT;
SET @cekdate = ISDATE(@filter);

IF(@akseposting ='Y')
 BEGIN
		IF(@cekdate =1)
			BEGIN
				IF(@flagtf ='NULL')
						BEGIN
						INSERT INTO #temptess
						SELECT TOP 15 SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
						where  YEAR(Shipdate) =@tahun AND flagsave='Y' AND flagposted ='Y' AND flagtransfer is NULL	 AND Shipdate =@filter ORDER BY Shipdate DESC;		
						END;
					ELSE
						BEGIN
						INSERT INTO #temptess
						SELECT TOP 15 SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
						where   YEAR(Shipdate) =@tahun AND flagsave='Y' AND flagposted ='Y' AND flagtransfer='TF'AND Shipdate =@filter ORDER BY Shipdate DESC;				
						END;
			END
		 ELSE
			BEGIN
				
				 IF(@filter ='NULL')
					BEGIN
							IF(@flagtf ='NULL')
								BEGIN
								INSERT INTO #temptess
								SELECT TOP 15 SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
								where  YEAR(Shipdate) =@tahun AND flagsave='Y' AND flagposted ='Y' AND flagtransfer is NULL  ORDER BY Shipdate DESC  ;		
								END;
							ELSE
								BEGIN
								INSERT INTO #temptess
								SELECT TOP 15 SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
								where   YEAR(Shipdate) =@tahun AND flagsave='Y' AND flagposted ='Y' AND flagtransfer='TF' ORDER BY Shipdate DESC;				
								END;
					END
				 ELSE
				 BEGIN
							IF(@flagtf ='NULL')
								BEGIN
								INSERT INTO #temptess
								SELECT TOP 15 SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
								where  YEAR(Shipdate) =@tahun AND flagsave='Y' AND flagposted ='Y' AND flagtransfer is NULL
								AND ( SoTransacID like @filter OR UserId like @filter ) ORDER BY Shipdate DESC;
								END;
							ELSE
								BEGIN
								INSERT INTO #temptess
								SELECT TOP 15 SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
								where   YEAR(Shipdate) =@tahun AND flagsave='Y' AND flagposted ='Y' AND flagtransfer='TF'
								AND ( SoTransacID like @filter OR UserId like @filter ) ORDER BY Shipdate DESC;
								END;
				 END
			END
  END;


ELSE 
 BEGIN
		IF(@cekdate =1)
			BEGIN
				IF(@flagtf ='NULL')
						BEGIN
						INSERT INTO #temptess
						SELECT TOP 15 SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
						where UserIDEntry=@userid AND YEAR(Shipdate) =@tahun AND flagsave='Y' AND flagposted ='Y' AND flagtransfer is NULL	 AND Shipdate =@filter ORDER BY Shipdate DESC;		
						END;
					ELSE
						BEGIN
						INSERT INTO #temptess
						SELECT TOP 15 SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
						where UserIDEntry=@userid AND  YEAR(Shipdate) =@tahun AND flagsave='Y' AND flagposted ='Y' AND flagtransfer='TF'AND Shipdate =@filter ORDER BY Shipdate DESC;				
						END;
			END
		 ELSE
			BEGIN
				
				 IF(@filter ='NULL')
					BEGIN
							IF(@flagtf ='NULL')
								BEGIN
								INSERT INTO #temptess
								SELECT TOP 15 SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
								where UserIDEntry=@userid AND YEAR(Shipdate) =@tahun AND flagsave='Y' AND flagposted ='Y' AND flagtransfer is NULL  ORDER BY Shipdate DESC  ;		
								END;
							ELSE
								BEGIN
								INSERT INTO #temptess
								SELECT TOP 15 SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
								where UserIDEntry=@userid AND  YEAR(Shipdate) =@tahun AND flagsave='Y' AND flagposted ='Y' AND flagtransfer='TF' ORDER BY Shipdate DESC;				
								END;
					END
				 ELSE
				 BEGIN
							IF(@flagtf ='NULL')
								BEGIN
								INSERT INTO #temptess
								SELECT TOP 15 SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
								where UserIDEntry=@userid AND YEAR(Shipdate) =@tahun AND flagsave='Y' AND flagposted ='Y' AND flagtransfer is NULL
								AND ( SoTransacID like @filter OR UserId like @filter ) ORDER BY Shipdate DESC;
								END;
							ELSE
								BEGIN
								INSERT INTO #temptess
								SELECT TOP 15 SoTransacID,Shipdate,SOEntryDesc,UserId FROM mutasi2 
								where UserIDEntry=@userid AND  YEAR(Shipdate) =@tahun AND flagsave='Y' AND flagposted ='Y' AND flagtransfer='TF'
								AND ( SoTransacID like @filter OR UserId like @filter ) ORDER BY Shipdate DESC;
								END;
				 END
			END
  END;

SELECT * FROM #temptess
END;

GO
EXEC SP_TampilListMutasiPostingRAD 'herman','2024','NULL' ,'Y','%WM240227131054%'




