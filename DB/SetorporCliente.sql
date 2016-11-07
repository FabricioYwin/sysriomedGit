use medx
select setor.id, setor.nome
from os

inner join cliente on
cliente.id = os.idCliente

inner join setor on
setor.id = os.idSetor


where cliente.id = (select usuario.idCliente from usuario where usuario.id = 72 )

group by setor.id, setor.nome
order by setor.nome


