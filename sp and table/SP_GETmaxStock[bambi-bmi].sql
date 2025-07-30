USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_GETmaxStock]    Script Date: 02/15/2024 10:06:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

ALTER PROCEDURE [dbo].[SP_GETmaxStock]
 @warehouse varchar(50),
 @PartId char(10),
 @shipdate datetime
AS





BEGIN
select a.partid, b.parttype, b.partname,b.product, b.um_big as unit_measure,b.um_big,b.um_small,b.harga_beli, 
sum(case a.flagupdatestock when '-' then (a.qty*-1) else a.qty end) as totalqty, 
sum(case a.flagupdatestock when '-' then (a.pcs*-1) else a.pcs end) as totalpcs, b.stock_max, b.stock_min 
from stockposting a, partmaster b, warehouse c where (a.whsid = @warehouse) and a.partid = @PartId 
and b.partid = a.partid and a.stocktransacdate <= @shipdate and a.whsid = c.whsid 
group by a.partid,b.parttype,b.product,b.partname,b.um_big,b.um_small,b.harga_beli, b.stock_max, b.stock_min
		

END

--GO
--EXEC SP_GETmaxStock 'AEONBSD','5551','02/13/2024'

