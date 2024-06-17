# HyperF poll API

This repository contains a simple Quiz/Poll API that allows to manage polls and expose them to users. The main concept is the 'async poll digest' to retrieve all users answers regardless of quantity, and handle all processing load, also making results available in real time.

## Development (using Docker/Podman)

```
git clone https://github.com/chsjr1996/hyperf-poll-api.git
```

```
cd hyperf-poll-api
```
```
docker compose up -d
```
> Or `podman compose up -d`

On 'podman' if needed run `podman build -t hyperf-skeleton .` to build image before to use 'up' compose command.

### Ports

- [HyperF API (9501)](http://localhost:9501)
- [Zipkin (9411)](http://localhost:9411)
- [Kafka UI (8081)](http://localhost:8081)
- Kafka (9092)
- MySQL (3306)

## TODO

### Features
- [ ] Async poll digest answers
- [ ] Real time poll results
...

### Engineering
- [x] DDD structure
- [x] Trace with Zipkin
- [ ] Setup k8s to simulate production env (producers and consumers separated...)
- [ ] Kafka as event store
...

### Others
- [ ] JWT Auth
...

---

## Under development
