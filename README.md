# Kriegerrand Explorer
Block explorer for Kriegerrand CryptoNote based cryptocurrency.

#### Installation

1) It takes data from daemon mindbraind. It should be accessible from the Internet. Run MindBraind with open port as follows:
```bash
./MindBraind --enable-cors="*" --enable_blockexplorer --rpc-bind-ip=0.0.0.0 --rpc-bind-port=11666
```
2) Just upload to your website and change 'api' variable in config.js to point to your daemon.

### Note
A lot of this code is from the TurtleCoin and Karbovanets
