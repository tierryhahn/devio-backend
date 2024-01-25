# Documentação do Backend - Teste Devio

## Inicializando o Servidor Localmente

Certifique-se de ter o ambiente PHP instalado em sua máquina.

1. **Clone este repositório:**

   ```bash
   git clone https://linkdoclone/backend.git
   cd backend
   
2. **Instale as dependências do Laravel:**
    ```bash
    composer install
    
3. **Configure o arquivo .env com as informações necessárias para o banco de dados.**
   
4. **Execute as migrações para criar as tabelas do banco de dados:**
   ```bash
   php artisan migrate
   
5. **Inicie o servidor.**
   ```bash
   php artisan serve

## Rotas e Funcionalidades
### Produtos

### 1. Obtém a lista de todos os produtos.

- **URL:** `/products`
- **Método:** `GET`
  
### 2. Obtém detalhes de um produto específico.

- **URL:** `/products/{id}`
- **Método:** `GET`
  
### 3. Adiciona um novo produto. Corpo da requisição:

- **URL:** `/products/`
- **Método:** `POST`
- **Input:**
  ```json
  {
  "name": "Nome do Produto",
  "code": "Código",
  "price": 19.99,
  "category": "Combos",
  "description": "Descrição opcional",
  "image": "URL da imagem opcional"
  }
  ```

### 4. Atualiza as informações de um produto existente. Corpo da requisição:

- **URL:** `/products/{id}`
- **Método:** `PUT`
- **Input:**
  ```json
  {
  "name": "Novo Nome do Produto",
  "code": "Novo Código",
  "price": 25.99,
  "category": "Acompanhamentos",
  "description": "Nova Descrição",
  "image": "Nova URL da imagem"
  }
  ```
  
### 5. Remove um produto.

- **URL:** `/products/{id}`
- **Método:** `DELETE`

### Pedidos
### 1. Obtém a lista de todos os pedidos.

- **URL:** `/orders`
- **Método:** `GET`
  
### 2. Obtém detalhes de um pedido específico.

- **URL:** `/orders/{id}`
- **Método:** `GET`

### 3. Cria um novo pedido. Corpo da requisição:

- **URL:** `/orders/`
- **Método:** `POST`
- **Input:**
  ```json
  {
  "customer_name": "Nome do Cliente",
  "total": 50.99,
  "change": 10.00,
  "observation": "Observações opcionais",
  "code": "Código do Pedido opcional"
  }
  ```

### 4. Atualiza as informações de um pedido existente. Corpo da requisição:

- **URL:** `/orders/{id}`
- **Método:** `PUT`
- **Input:**
  ```json
  {
  "customer_name": "Novo Nome do Cliente",
  "total": 60.99,
  "change": 15.00,
  "observation": "Novas Observações"
  }
  ```

### 5. Remove um pedido e todos os seus itens associados.

- **URL:** `/orders/{id}`
- **Método:** `DELETE`

### Itens do Pedido
### 1. Adiciona um item a um pedido. Corpo da requisição:

- **URL:** `/orders/{orderId}/items`
- **Método:** `POST`
- **Input:**
  ```json
  {
  "product_id": 1,
  "quantity": 2
  }
  ```
  
### 2. Remove um item de um pedido.

- **URL:** `/orders/{orderId}/items/{itemId}`
- **Método:** `DELETE`

### Pagamentos
### Registra um pagamento para um pedido. Corpo da requisição:

- **URL:** `/orders/{orderId}/payments`
- **Método:** `POST`
- **Input:**
  ```json
  {
  "payment_method": "Cartão de Crédito",
  "amount": 30.00
  }
  ```
  
### 2. Remove um pagamento de um pedido.
- **URL:** `/orders/{orderId}/payments/{paymentId}`
- **Método:** `DELETE`

### Cozinha
### Obtém a lista de todos os pedidos da cozinha.

- **URL:** `/kitchen-orders`
- **Método:** `GET`
  
### 2. Marca um pedido da cozinha como completo.
- **URL:** `/kitchen-orders/{id}/complete`
- **Método:** `PUT`
  
  
