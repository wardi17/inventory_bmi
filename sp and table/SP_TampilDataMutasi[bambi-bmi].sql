USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_TampilDataMutasi]    Script Date: 02/26/2024 11:17:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_TampilDataMutasi]
@SoTransacID char(15)
AS


BEGIN
SELECT Shipdate,SOEntryDesc FROM  mutasi2 where SoTransacID=@SoTransacID AND flagsave is NULL AND flagposted ='N'		
END;

