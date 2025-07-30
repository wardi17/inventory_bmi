select a.partid, b.parttype, b.partname,b.product, b.um_big as unit_measure,b.um_big,b.um_small,b.harga_beli, 
sum(case a.flagupdatestock when '-' then (a.qty*-1) else a.qty end) as totalqty, 
sum(case a.flagupdatestock when '-' then (a.pcs*-1) else a.pcs end) as totalpcs, b.stock_max, b.stock_min 
from stockposting a, partmaster b, warehouse c where (a.whsid = 'BMI-GK') and a.partid = '1010-01' 
and b.partid = a.partid and a.stocktransacdate <= '02/15/2024' and a.whsid = c.whsid 
group by a.partid,b.parttype,b.product,b.partname,b.um_big,b.um_small,b.harga_beli, b.stock_max, b.stock_min