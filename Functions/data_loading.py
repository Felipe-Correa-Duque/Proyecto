pip install pandas sqlalchemy openpyxl
import pandas as pd
from sqlalchemy import create_engine

# Establecer la conexión con la base de datos
db_engine = create_engine('database_connection_string')
# Cargar el archivo Excel en un DataFrame
counties_df = pd.read_excel('counties.xlsx')

# Realizar las operaciones de limpieza necesarias en el DataFrame counties_df
# ...

# Si es necesario, puedes hacer más manipulaciones en los datos para limpiarlos
# y darles el formato adecuado antes de insertarlos en la base de datos.
# Insertar los datos en la base de datos utilizando el DataFrame y la conexión establecida
counties_df.to_sql('counties_table_name', db_engine, if_exists='replace')
