from graphviz import Digraph

dot = Digraph(comment='Diagrama ER ARCINEMA', format='png')

dot.attr(rankdir='LR')

# Tablas principales

dot.node('Cines', 'cines\n- id (PK)\n- nombre\n- direccion\n- ciudad\n- telefono\n- email\n- estado')
dot.node('Salas', 'salas\n- id (PK)\n- cine_id (FK)\n- nombre\n- capacidad\n- tipo_sala\n- estado')
dot.node('Peliculas', 'peliculas\n- id (PK)\n- titulo\n- descripcion\n- duracion\n- genero\n- clasificacion\n- poster_url\n- trailer_url\n- estado')
dot.node('Funciones', 'funciones\n- id (PK)\n- pelicula_id (FK)\n- sala_id (FK)\n- fecha\n- hora_inicio\n- hora_fin\n- precio_base\n- estado')
dot.node('Butacas', 'butacas\n- id (PK)\n- sala_id (FK)\n- fila\n- numero\n- estado')
dot.node('Usuarios', 'usuarios\n- id (PK)\n- nombre\n- apellidos\n- email\n- password\n- telefono\n- rol\n- estado')
dot.node('Reservas', 'reservas\n- id (PK)\n- usuario_id (FK)\n- funcion_id (FK)\n- fecha_reserva\n- estado\n- total')
dot.node('ReservaButacas', 'reserva_butacas\n- id (PK)\n- reserva_id (FK)\n- butaca_id (FK)\n- precio')

# Relaciones

dot.edge('Cines', 'Salas', label='1:N')
dot.edge('Salas', 'Butacas', label='1:N')
dot.edge('Salas', 'Funciones', label='1:N')
dot.edge('Peliculas', 'Funciones', label='1:N')
dot.edge('Usuarios', 'Reservas', label='1:N')
dot.edge('Funciones', 'Reservas', label='1:N')
dot.edge('Reservas', 'ReservaButacas', label='1:N')
dot.edge('Butacas', 'ReservaButacas', label='1:N')

# Generar el archivo PNG
dot.render('er_diagrama_arcinema', directory='.', cleanup=True)
print('Diagrama ER generado como er_diagrama_arcinema.png') 