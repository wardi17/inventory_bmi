USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_INSERT_MUTASI]    Script Date: 02/13/2024 16:16:24 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_INSERT_MUTASI]
@transnohider char(15),
@shipdate datetime,
@soentrydesc text,
@dateentry datetime,
@useridenty char(10),
@userid char(10),
@flagtf char(10)
AS
IF(@flagtf ='NULL')
	BEGIN 
	INSERT  INTO mutasi2(SoTransacID,Shipdate,SOEntryDesc,DateEntry,UserIDEntry,UserId)
	 VALUES(@transnohider,@shipdate,@soentrydesc,@dateentry,@useridenty,@userid)
	END
ELSE
	BEGIN 
	INSERT  INTO mutasi2(SoTransacID,Shipdate,SOEntryDesc,DateEntry,UserIDEntry,UserId,flagtransfer)
	 VALUES(@transnohider,@shipdate,@soentrydesc,@dateentry,@useridenty,@userid,@flagtf)
	END

SELECT * FROM mutasi2 where SoTransacID =@transnohider
DELETE FROM mutasi2 where SoTransacID =@transnohider
GO
--EXEC SP_INSERT_MUTASI 'FG240213161615','2024-02-13','','2024-02-13 16:22:04','herman','herman','NULL'