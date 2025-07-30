USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_GetTransType]    Script Date: 01/31/2024 08:22:02 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_GetTransType]

AS


BEGIN
SELECT code,description FROM trantypefg order by number ASC 					
END;

