import React, { useState, useEffect } from 'react'
import {NotifyError} from "../../services/notification.service";

interface Props{
    // getAdblock?: (v: boolean) => void
}
const AdblockDetect: React.FC<Props> = (props: Props) => {
    const [usingAdblock, setUsingAdblock] = useState(false)

    let fakeAdBanner: any;
    useEffect(() => {
        if (fakeAdBanner) {
            setUsingAdblock(fakeAdBanner.offsetHeight === 0)
        }

        // eslint-disable-next-line react-hooks/exhaustive-deps
    },[])

    if (usingAdblock === true) {
        NotifyError(`AdBlock terdeteksi.`, `Matikan plugin AdBlock lalu muat ulang halaman untuk menjalankan fungsi cetak!`);
        return null
    }

    return (
        <div>
            <div
                ref={r => (fakeAdBanner = r)}
                style={{ height: '1px', width: '1px', visibility: 'hidden', pointerEvents: 'none' }}
                className="adBanner"
            />
        </div>
    )
}

export default AdblockDetect
