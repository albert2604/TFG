from graphviz import Digraph

dot = Digraph(comment='Diagrama de Flujo - Proceso de Reserva ARCINEMA', format='png')
dot.attr(rankdir='TB')

# Estilo general
dot.attr('node', shape='box', style='rounded,filled', fillcolor='lightblue')
dot.attr('edge', color='gray')

# Nodos principales
dot.node('inicio', 'Inicio\nPágina Principal', shape='oval', fillcolor='lightgreen')
dot.node('seleccion_cine', 'Selección de Cine', shape='box', fillcolor='lightblue')
dot.node('seleccion_pelicula', 'Selección de Película', shape='box', fillcolor='lightblue')
dot.node('seleccion_funcion', 'Selección de Función', shape='box', fillcolor='lightblue')
dot.node('seleccion_butacas', 'Selección de Butacas', shape='box', fillcolor='lightblue')
dot.node('confirmacion', 'Confirmación de Reserva', shape='box', fillcolor='lightblue')
dot.node('pago', 'Proceso de Pago', shape='box', fillcolor='lightblue')
dot.node('final', 'Reserva Completada', shape='oval', fillcolor='lightgreen')

# Nodos de decisión
dot.node('usuario_logueado', '¿Usuario Logueado?', shape='diamond', fillcolor='lightyellow')
dot.node('butacas_disponibles', '¿Butacas Disponibles?', shape='diamond', fillcolor='lightyellow')
dot.node('pago_exitoso', '¿Pago Exitoso?', shape='diamond', fillcolor='lightyellow')

# Conexiones principales
dot.edge('inicio', 'usuario_logueado')
dot.edge('usuario_logueado', 'seleccion_cine', label='Sí')
dot.edge('usuario_logueado', 'login', label='No')
dot.edge('login', 'seleccion_cine')
dot.edge('seleccion_cine', 'seleccion_pelicula')
dot.edge('seleccion_pelicula', 'seleccion_funcion')
dot.edge('seleccion_funcion', 'seleccion_butacas')
dot.edge('seleccion_butacas', 'butacas_disponibles')
dot.edge('butacas_disponibles', 'confirmacion', label='Sí')
dot.edge('butacas_disponibles', 'seleccion_butacas', label='No')
dot.edge('confirmacion', 'pago')
dot.edge('pago', 'pago_exitoso')
dot.edge('pago_exitoso', 'final', label='Sí')
dot.edge('pago_exitoso', 'pago', label='No')

# Nodos adicionales
dot.node('login', 'Login/Registro', shape='box', fillcolor='lightblue')
dot.node('error', 'Error en el Proceso', shape='box', fillcolor='lightpink')

# Conexiones de error
dot.edge('pago_exitoso', 'error', label='Error Crítico')

# Guardar el diagrama
dot.render('diagrama_flujo_reserva', directory='.', cleanup=True)
print('Diagrama de flujo generado como diagrama_flujo_reserva.png') 