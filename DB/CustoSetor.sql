use medx
SELECT count(os.id), setor.nome as nomeSetor, sum(itemMaterial.valorUnitario) as CustoTotal
  FROM os

  inner join setor on
  setor.id = os.idSetor

  inner join itemMaterial on 
  ItemMaterial.id = os.idItemMaterial

  inner join cliente on
  cliente.id = os.idCliente

  where cliente.id = (select usuario.idCliente from usuario where usuario.login = 'julio') 

  group by setor.nome