Router performance benchmark
============================

**These benchmarks are purely informational, to help identify ways we can**
**improve overall framework performance and should not be used to persuade**
**your framework decisions in any way. Router performance alone is in no way**
**indicitive of overall framework performance, and is extremely unlikely to be**
**a bottleneck in any project or application.**

This is a simple suite to compare performance of different routers. For each
router, the exact same routing structure is created. Then, the performance for
both the first route matching and the last route matching is tested.

On an Intel Core i7-3930K CPU @ 3.20GHz, the following results were achieved:

```
RouterBenchmark\DashEvent
    Method Name   Iterations    Average Time      Ops/second
    ----------  ------------  --------------    -------------
    firstMatch: [1,000     ] [0.0003087394238] [3,238.97735]
    lastMatch : [1,000     ] [0.0003219761848] [3,105.81977]


RouterBenchmark\SymfonyEvent
    Method Name   Iterations    Average Time      Ops/second
    ----------  ------------  --------------    -------------
    firstMatch: [1,000     ] [0.0011287193298] [885.95984]
    lastMatch : [1,000     ] [0.0006017644405] [1,661.77981]


RouterBenchmark\Zf2Event
    Method Name   Iterations    Average Time      Ops/second
    ----------  ------------  --------------    -------------
    firstMatch: [1,000     ] [0.0013284144402] [752.77712]
    lastMatch : [1,000     ] [0.0010156590939] [984.58233]
```

You can run the tests yourself with the following command:

```vendor/bin/athletic -p src/```
