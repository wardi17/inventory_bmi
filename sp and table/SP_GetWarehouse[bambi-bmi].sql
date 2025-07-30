USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_GetWarehouse]    Script Date: 01/31/2024 08:22:59 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_GetWarehouse]

AS


BEGIN
SELECT WHSID,WHSName FROM warehouse  where parttype='FG' AND WHSID <>'BMI'	order by WHSID ASC				
END;

--go
--EXEC SP_GetTransType
