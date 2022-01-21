#simple websockets brocaster
import asyncio
import websockets
clients = [] #to store all connected cleints

#handler for socket message activities
# 處理 socket
# websocket 連線進來的物件，做連線用的
# 可以把登入，經認證後的訊息放置 socket
async def handler(websocket, path): # 可以在這邊加上邏輯的判斷
    print(path) #path is not used currently
    if websocket not in clients: # 如果是新的連線
        clients.append(websocket) #append new cleint to the array
        
    # 連線進來的 client 傳了很多訊息
    async for message in websocket:
        print(message,'received from client') #print to console
        # 把他的訊息，送給 "所有" 的client
        await brocast(message) #send message to all clents

# 做廣播
async def brocast(msg):
    print(msg,' brocasting') #print to console

    #iterate the clients
    # 對每一個連線，用client的websocket
    for websock in clients:
        try: 
            await websock.send(msg) #send message to each client
        # 如果斷線的話
        except websockets.exceptions.ConnectionClosed:
            #remove the client when it disconnects
            print("Client disconnected.  Do cleanup")
            clients.remove(websock) # 將此 clients 從連線清單移除
            #pass

#starts the service and run forever
asyncio.get_event_loop().run_until_complete(
    websockets.serve(handler, 'localhost', 4545)) #hook to localhost:4545
asyncio.get_event_loop().run_forever()
