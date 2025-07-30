USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_UPDATE_MUTASI]    Script Date: 02/19/2024 15:07:40 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_UPDATE_MUTASI]
@transnohider char(15),
@shipdate datetime,
@soentrydesc text,
@dateentry datetime,
@useridenty char(10),
@userid char(10)
AS

BEGIN 
UPDATE  mutasi2  SET Shipdate =@shipdate,SOEntryDesc=@soentrydesc,DateEntry=@dateentry,
UserIDEntry=@useridenty WHERE SoTransacID =@transnohider
END
