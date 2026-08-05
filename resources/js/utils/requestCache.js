const cache = new Map();
const DEFAULT_TTL = 30000;

export function getCacheKey(config) {
    const params = config.params
        ? JSON.stringify(config.params)
        : "";
    return `${config.method.toUpperCase()} ${config.url}?${params}`;
}

export function getCached(key) {
    const entry = cache.get(key);
    if (!entry) return null;
    if (Date.now() > entry.expiresAt) {
        cache.delete(key);
        return null;
    }
    return entry.data;
}

export function setCache(key, data, ttl = DEFAULT_TTL) {
    cache.set(key, { data, expiresAt: Date.now() + ttl });
}

export function clearCache() {
    cache.clear();
}
