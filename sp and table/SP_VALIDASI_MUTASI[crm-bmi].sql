USE [crm-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_VALIDASI_MUTASI]    Script Date: 03/07/2024 16:42:24 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

ALTER PROCEDURE [dbo].[SP_VALIDASI_MUTASI]
@SOTransacID varchar(15),
@userid char(30)
AS


BEGIN
DECLARE @Shipdate datetime;
 SET @Shipdate = (SELECT Shipdate FROM  [bambi-bmi].[dbo].mutasi2 WHERE SoTransacID =@SOTransacID);
END

BEGIN
		SELECT
		@Shipdate AS Shipdate,PartId,PartName,warehouse,warehouse2,Quantity,transtype,(select flagupdatestock from [bambi-bmi].[dbo].trantypefg where code=transtype) AS flagstock
		FROM [bambi-bmi].[dbo].mutasidetail2 WHERE SoTransacID =@SOTransacID ORDER BY Itemno ASC;
		
END


--GO	
--EXEC SP_VALIDASI_MUTASI 'FG240215164342','herman'

--select * from [bambi-bmi].[dbo].mutasidetail2


