use medx
select setor.nome, sum(itemMaterial.valorUnitario) as custo

from os

inner join itemMaterial on 
itemMaterial.id = os.idItemMaterial

inner join cliente on
cliente.id = os.idCliente

inner join setor on
setor.id = os.idSetor

where cliente.id = (select usuario.idCliente from usuario where usuario.login = 'julio') and
os.dataHora >= '01/08/2016' AND os.dataHora <= '31/08/2016'

group by setor.nome 