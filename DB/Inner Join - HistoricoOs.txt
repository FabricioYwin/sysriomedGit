use medx;

select os.id, historicoOS.etapa, historicoOS.descricao, usuario.login, historicoOS.dataHora
from os 

inner join historicoOS on
os.id = historicoOS.idOs

inner join usuario on
usuario.id = historicoOS.idUsuario

 where  os.id = 47864