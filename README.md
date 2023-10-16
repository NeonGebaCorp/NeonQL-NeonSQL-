
# NeonQL Server Usage Guide

NeonQL is a lightweight SQL server designed for simplicity and ease of use. It allows you to interact with your data using GET, PUT, DELETE, and TESTAUTH operations.

## GET Data

To retrieve data from the NeonQL server, use the following command:

```bash
curl -X POST -d "password=<your_password>&dataname=<your_dataname>" http://your_neonql_server_url/GET.php
```

- Replace `<your_password>` with your password.
- Replace `<your_dataname>` with the name of the data you want to retrieve.
- Replace `http://your_neonql_server_url` with the actual URL of your NeonQL server.

## PUT Data

To store data in the NeonQL server, use the following command:

```bash
curl -X POST -d "password=<your_password>&dataname=<your_dataname>&data=<your_data_to_store>" http://your_neonql_server_url/PUT.php
```

- Replace `<your_password>` with your password.
- Replace `<your_dataname>` with the name of the data you want to store.
- Replace `<your_data_to_store>` with the data you want to store.
- Replace `http://your_neonql_server_url` with the actual URL of your NeonQL server.

## DELETE Data

To remove data from the NeonQL server, use the following command:

```bash
curl -X POST -d "password=<your_password>&dataname=<your_dataname>" http://your_neonql_server_url/DELETE.php
```

- Replace `<your_password>` with your password.
- Replace `<your_dataname>` with the name of the data you want to delete.
- Replace `http://your_neonql_server_url` with the actual URL of your NeonQL server.

## Authenticate

To test authentication, use the following command:

```bash
curl -X POST -d "password=<your_password>" http://your_neonql_server_url/TESTAUTH.php
```

- Replace `<your_password>` with your password.
- Replace `http://your_neonql_server_url` with the actual URL of your NeonQL server.

This guide provides commands for using the NeonQL server to perform GET, PUT, DELETE, and TESTAUTH operations on your data. Replace the placeholders with your specific values and server URL.


