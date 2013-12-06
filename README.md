Router performance benchmark
============================

**These benchmarks are purely informational, to help identify ways we can**
**improve overall framework performance and should not be used to persuade**
**your framework decisions in any way. Router performance alone is in no way**
**indicative of overall framework performance, and is extremely unlikely to be**
**a bottleneck in any project or application.**

This is a simple suite to compare performance of different routers. For each
router, the exact same routing structure is created. Then, the performance for
both the first route matching and the last route matching is tested.

To properly simulate per-request matching, as this is what usually happens,
every router is destroyed after each iterations and completely re-created again.

On an Intel Core i7-3930K CPU @ 3.20GHz, the following results were achieved:

```
RouterBenchmark\DashEvent
    Method Name   Iterations    Average Time      Ops/second
    ----------  ------------  --------------    -------------
    firstMatch: [1,000     ] [0.0003096990585] [3,228.94104]
    lastMatch : [1,000     ] [0.0003116433620] [3,208.79608]
    assemble  : [1,000     ] [0.0004264097214] [2,345.16229]


RouterBenchmark\SymfonyEvent
    Method Name   Iterations    Average Time      Ops/second
    ----------  ------------  --------------    -------------
    firstMatch: [1,000     ] [0.0011225581169] [890.82247]
    lastMatch : [1,000     ] [0.0005912811756] [1,691.24275]
    assemble  : [1,000     ] [0.0004174382687] [2,395.56379]


RouterBenchmark\Zf2Event
    Method Name   Iterations    Average Time      Ops/second
    ----------  ------------  --------------    -------------
    firstMatch: [1,000     ] [0.0013013062477] [768.45862]
    lastMatch : [1,000     ] [0.0009987037182] [1,001.29796]
    assemble  : [1,000     ] [0.0011002471447] [908.88670]
```

You can run the tests yourself with the following command:

```vendor/bin/athletic -p src/```
