use medx;

select distinct os.id, material.id, Material.nome, itemMaterial.matQuantidade as Quant, itemMaterial.valorUnitario
from os 

inner join itemMaterial on
itemMaterial.id = os.idItemMaterial 

inner join material on
material.id = itemMaterial.idMaterial

inner join movimentoItemMaterial on
itemMaterial.id = movimentoItemMaterial.idItemMaterial

 where  os.id = 70843