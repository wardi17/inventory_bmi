USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_Getpartid]    Script Date: 01/31/2024 08:18:40 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_Getpartid]

@filterdata varchar(100)
AS

BEGIN
SELECT  partid,partname FROM partmaster  where parttype='FG' AND divisi=1 AND partid like @filterdata	order by partid ASC	
END;

go
--EXEC SP_Getpartid '1170M-05%'

--2126-14
--SELECT *  FROM partmaster  where partid='5037' order by partid ASC	

--UPDATE  partmaster SET divisi=1  where partid='5037'
-- gudang BMI-GK

--6250-03
--7599-18

--6232-03
--6232-04


-- select * from partmaster  where partid='8725sk-10'
-- select * from partmaster  where partid='7311sp-01'

-- UPDATE  partmaster SET divisi=1  where partid='8725sk-10'
-- UPDATE  partmaster SET divisi=1  where partid='7311sp-01'
