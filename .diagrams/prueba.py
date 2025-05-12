from diagrams import Diagram, Cluster
from diagrams.onprem.client import Users
from diagrams.programming.language import PHP
from diagrams.custom import Custom
from diagrams.onprem.database import MySQL
from diagrams.azure.network import Connections

with Diagram("ARCINEMA - Arquitectura del Proyecto", show=False, direction="TB"):

    with Cluster("Usuarios"):
        user = Users("Clientes")
    
    with Cluster("Admins"):
        admin = Users("Gestores")
        
    with Cluster("API REST"):
        api = Connections("API REST")

    with Cluster("Frontend"):
        frontend = PHP("PHP")
        bootstrap = Custom("Bootstrap", "./bootstrap.png")

    with Cluster("Backend/API"):
        directus = Custom("Directus", "./directus.jpg")

    with Cluster("Base de Datos"):
        db = MySQL("MySQL")


    user >> frontend
    frontend >> bootstrap
    directus >> db
    admin >> directus
    frontend >> api >> directus

   

